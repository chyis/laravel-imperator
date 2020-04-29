<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Models\Classification;
use Chyis\Imperator\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends AdminController
{
    public function index(Request $request)
    {
        $keyWord = $request->input('keyword');
        $condition = [];

        if ($keyWord != '')
        {
            $condition[] = ['no', $keyWord];
        }
        $query = Order::orderBy('id', 'desc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::orders.index')
            ->with('lists', $list)
            ->with('pageName', '订单列表')
            ->with('request', $request->toArray());
    }


    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classification::dirRoot();

        return view('Imperator::orders.create')
            ->with('pageName', '订单添加')
            ->with('classes', $classes);
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $cate = new Order();


        $cate->no = $request->input('cate_name');
        $cate->parent_id = $request->input('parent_id');
        $cate->type_id = $request->input('type_id');
        $cate->sort = $request->input('sort');
        $cate->image = $request->input('image') ?? '';
        $cate->create_uid = 1;
        $res = $cate->saveOrFail();
        if ($res)
        {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Order  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Order $orders)
    {
        return view('Imperator:orders.show')
            ->with('pageName', '订单详情')
            ->with('order', $orders);
    }

    /**
     * edit order shipping status.
     *
     * @param  \Chyis\Imperator\Models\Order $order
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function ship(Order $order, Request $request)
    {
        if (!$order->paid_at) {
            throw new InvalidRequestException('该工单未付款');
        }
        if ($order->ship_status !== Order::SHIP_STATUS_PENDING) {
            throw new InvalidRequestException('该工单已发货');
        }
        $data = $this->validate($request, [
            'express_company' => ['required'],
            'express_no'      => ['required'],
        ], [], [
            'express_company' => '物流公司',
            'express_no'      => '物流单号',
        ]);
        $order->update([
            'ship_status' => Order::SHIP_STATUS_DELIVERED,
            'ship_data'   => $data,
        ]);

        return $this->success('物流状态');
    }

    public function handleRefund(Order $order, HandleRefundRequest $request)
    {
        // 判断工单状态是否正确
        if ($order->refund_status !== Order::REFUND_STATUS_APPLIED) {
            throw new InvalidRequestException('工单状态不正确');
        }
        // 是否同意退款
        if ($request->input('agree')) {
            // 清空拒绝退款理
            $extra = $order->extra ?: [];
            unset($extra['refund_disagree_reason']);
            $order->update([
                'extra' => $extra,
            ]);
            // 调用退款逻辑
            $this->_refundOrder($order);
        } else {
            // 将拒绝退款理由放到工单的 extra 字段中
            $extra = $order->extra ?: [];
            $extra['refund_disagree_reason'] = $request->input('reason');
            // 将工单的退款状态改为未退款
            $order->update([
                'refund_status' => Order::REFUND_STATUS_PENDING,
                'extra'         => $extra,
            ]);
        }

        return $order;
    }

    protected function _refundOrder(Order $order)
    {
        // 判断该工单的支付方式
        switch ($order->payment_method) {
            case 'wechat':
                // 生成退款工单号
                $refundNo = Order::getAvailableRefundNo();
                app('wechat_pay')->refund([
                    'out_trade_no' => $order->no, // 之前的工单流水号
                    'total_fee' => $order->total_amount * 100, //原工单金额，单位分
                    'refund_fee' => $order->total_amount * 100, // 要退款的工单金额，单位分
                    'out_refund_no' => $refundNo, // 退款工单号
                    // 微信支付的退款结果并不是实时返回的，而是通过退款回调来通知，因此这里需要配上退款回调接口地址
                    'notify_url' => route('payment.wechat.refund_notify'),
                ]);
                // 将工单状态改成退款中
                $order->update([
                    'refund_no' => $refundNo,
                    'refund_status' => Order::REFUND_STATUS_PROCESSING,
                ]);
                break;
            case 'alipay':
                $refundNo = Order::getAvailableRefundNo();
                // 调用支付宝支付实例的 refund 方法
                $ret = app('alipay')->refund([
                    'out_trade_no' => $order->no, // 之前的工单流水号
                    'refund_amount' => $order->total_amount, // 退款金额，单位元
                    'out_request_no' => $refundNo, // 退款工单号
                ]);
                // 根据支付宝的文档，如果返回值里有 sub_code 字段说明退款失败
                if ($ret->sub_code) {
                    // 将退款失败的保存存入 extra 字段
                    $extra = $order->extra;
                    $extra['refund_failed_code'] = $ret->sub_code;
                    // 将工单的退款状态标记为退款失败
                    $order->update([
                        'refund_no' => $refundNo,
                        'refund_status' => Order::REFUND_STATUS_FAILED,
                        'extra' => $extra,
                    ]);
                } else {
                    // 将工单的退款状态标记为退款成功并保存退款工单号
                    $order->update([
                        'refund_no' => $refundNo,
                        'refund_status' => Order::REFUND_STATUS_SUCCESS,
                    ]);
                }
                break;
            default:
                // 原则上不可能出现，这个只是为了代码健壮性
                throw new InternalException('未知工单支付方式：'.$order->payment_method);
                break;
        }
    }

    public function destroy(int $orders)
    {
        $order = Order::find($orders);
        if ($order) {

        }

        return $this->error('参数错误，操作失败');
    }
}

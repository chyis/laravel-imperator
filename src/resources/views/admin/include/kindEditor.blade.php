	<link rel="stylesheet" href="/statics/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="/statics/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="/statics/kindeditor/kindeditor-all-min.js"></script>
	<script charset="utf-8" src="/statics/kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="/statics/kindeditor/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '/statics/kindeditor/plugins/code/prettify.css',
				uploadJson : '/statics/kindeditor/php/upload_json.php',
				fileManagerJson : '/statics/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[id=mainForm]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[id=mainForm]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
	<textarea name="content" style="width:700px;height:200px;visibility:hidden;">{{$entity->content??''}}</textarea>
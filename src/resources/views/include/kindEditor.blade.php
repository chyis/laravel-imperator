	<link rel="stylesheet" href="{{$staticDir}}/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="{{$staticDir}}/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="{{$staticDir}}/kindeditor/kindeditor-all-min.js"></script>
	<script charset="utf-8" src="{{$staticDir}}/kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="{{$staticDir}}/kindeditor/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '{{$staticDir}}/kindeditor/plugins/code/prettify.css',
				uploadJson : '{{$staticDir}}/kindeditor/php/upload_json.php',
				fileManagerJson : '{{$staticDir}}/kindeditor/php/file_manager_json.php',
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
<?php
include("data_tree.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>jsTree test</title>
  <!-- 2 load the theme CSS file -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
</head>
<body>
  <!-- 3 setup a container element -->
	<p><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;&nbsp;Select area :</p> 
  <div id="jstree">
  </div>


  <!-- 5 include the minified jstree source -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
  <script>
  $(function () {
    // 6 create an instance when the DOM is ready
    //$('#jstree').jstree();
    $('#jstree').jstree(
		{
			'core' :
			{
				'data' : [<?=$final_str_json?>]
			},
			types:
			{
				"root":
				{
					"icon":"glyphicon glyphicon-folder-close"
				},
				"child":
				{
					"icon" : "<?=$stat?>"
				},
				"default" :
				{
					
				}
		},
		plugins: ["types"]
		});
    // 7 bind to events triggered on the tree
    $('#jstree').on("changed.jstree", function (e, data) {
      //console.log(data);
      //console.log(data.node.original.text);
	  //console.log(data.node.parent);
	  var parent = "";
	  if (data.node.parent=="#")
	  {
		parent = "true";
	  }
	  else
	  {
		parent = data.node.parent;
	  }
	  
	  window.location.replace("main.php?page_id=bts&id="+data.selected+'&area='+data.node.original.text+'&parent='+parent);
	  
    });
    // 8 interact with the tree - either way is OK
    $('button').on('click', function () {
      $('#jstree').jstree(true).select_node('child_node_1');
      $('#jstree').jstree('select_node', 'child_node_1');
      $.jstree.reference('#jstree').select_node('child_node_1');
    });
  });
  </script>
</body>
</html>
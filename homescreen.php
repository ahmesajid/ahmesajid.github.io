<!DOCTYPE html>
<html>
	<head>
		  <script type="text/javascript" src="jquery.js"></script>
		 <title>Student Home Screen</title>
		 <style type="text/css">
		 	.btn
		 	{
		 		background-color: white;
		 		border-radius: 1.5vw;
		 		padding:0.3vw;
		 		cursor: pointer;
		 		border:2px solid black;
		 		width:max-content;
		 		text-align: center;
		 		font-size: 1.5vw;
		 		font-weight: bold;
	    		 user-select: none;
		 	}
		 	.btn:hover
		 	{
		 		background-color:#5AA73B;
		 		color:white;
		 	}
		 </style>
	</head>
	<body>
		<?php
		session_start();
		require ("connection.php");

		//REFERRING THIS PAGE
			if(!isset($_SESSION["user-std"]))
			{
				$isUser = false;
				$name_ = $_REQUEST["name"];
				$password_ = $_REQUEST["password"];
				$query = "SELECT name , login , password FROM student WHERE login='$name_' AND password='$password_'";
				$result = mysqli_query($con , $query);

				if($row = mysqli_fetch_assoc($result))
				{
					    $_SESSION["user-std"]=$row["name"];
						$isUser = true;
						$n = "Welcome ". $_SESSION["user-std"];
				}
				else
				{
		    		header("location:loginscreen.php");
				}
				if(!$isUser)
				{
					$_SESSION["invalid"] = "Invalid ID or Paswword";
				}
		    }
		?>
		<button style="float:right;" id="logout-btn" onclick="window.location.href='loginscreen.php'">Logout</button>


		<?php
		if(isset($_SESSION["user-std"]))
		{
			echo "<h1 style='text-align:center;'>Welcome ".$_SESSION["user-std"]."</h1>";
		}
		?>
		
		<div style="text-align:center;"><button id="add-folder1">+Add Folder</button></div></br>
		<div  name="folder-name" id="folder-name" style="text-align:center;">
			Enter folder name here <input type="text" id="fname">
			<button id="add-folder2">Add</button>
		</div>

		<div id="reload" >
			<a id="reload-btn" href='homescreen.php'">reload page</a>
		</div>
		<div id="append-div" >

        </div>

		<script type="text/javascript">
			var id=0;
			var isGreen=false;
	        $(document).ready(function()
	        {
	        	$("#folder-name").hide();
	        	defaultAjaxHit();
	        	$("#add-folder1").click(function()
	        		{
			        	$("#folder-name").slideToggle();
	        		});
	        	$("#add-folder2").click(function()
	        		{
	        			var getName = $("#fname").val();
	        			if(getName!='')
	        			{
	        				addFolderAjaxHit(getName);
	        			}
	        		});
	        });
	        function addFolderAjaxHit(getName)
	        {
	        	var sendData = {"action":"addFolder","pid":id,"inp-name":getName};
	                var settings = {
	                    type:"POST",
	                    dataType:"JSON",
	                    url:"api.php",
	                    data:sendData,
	                    success:function(response)
	                    {
	                    	if(response==0)
	                    	{
	                    		alert("Name already exists!");
	                    	}
	                    	else
	                    	{
	                    		var but = $("<div>").text(getName).addClass("btn");
		                		$("#append-div").append(but).append("</br>");
		                		but.click(function()
		                			{
		                				if(isGreen)
		                				{
		                					$(this).css("color","black");
		                					$(this).css("background-color","white");
		                					isGreen=false;
		                				}
		                				else
		                				{
		                					$(this).css("color","white");
		                					$(this).css("background-color","#5AA73B");
		                					isGreen=true;
		                				}
		                				
		                			});
		                		but.dblclick(function()
				                {
					        			id = this.id;
					        			alert(id);
				                		customAjaxHitOnButtonClick(id);
			        			}
		        				);
	                    	}
	                    },
	                    error:showError
	                };
	                $.ajax(settings);
	        }

	        function showResponse(response)
	        {
	        	$("#append-div").empty();
	        	$("#append-div").append("<h2>Here are the folders in your directory:</h2></br>");
	        	if(response.length>0)
	        	{
		            for(var i=0;i<response[0].length;i++)
		            {
		                var but = $("<div>").text(response[0][i]).attr("id",response[1][i]).addClass("btn");
		                $("#append-div").append(but).append("</br>");
		                but.click(function()
            			{
            				if(isGreen)
            				{
            					$(this).css("color","black");
            					$(this).css("background-color","white");
            					isGreen=false;
            				}
            				else
            				{
            					$(this).css("color","white");
            					$(this).css("background-color","#5AA73B");
            					isGreen=true;
            				}
            				
            			});

		                but.dblclick(function()
		                {
			        			id = this.id;
		                		customAjaxHitOnButtonClick(id);
	        			}
        				);
	    			}
	        	}
	        	else
	        	{
	        		//APPEND BACK BTN
	        		$("#append-div").append("<h2>Folder is empty</h2></br>");
	        	}
	};
	        function showError()
	        {
	            window.alert("An error occured while loading page!");
	        }
	        function appendBackBtn()
	        {
	        	var backBtn = $("<button>go back</button>");
        		$("#append-div").append(backBtn).append("</br></br>");
        		backBtn.click(function()
    			{
    				var childId = $(".btn").id;
    				alert(childId);
    			});
	        }
	        function defaultAjaxHit()
	        {
	        	var sendData = {"action":"bringFolders"};
	                var settings = {
	                    type:"POST",
	                    dataType:"JSON",
	                    url:"api.php",
	                    data:sendData,
	                    success:showResponse,
	                    error:showError
	                };
	                $.ajax(settings);
	        }
	        function customAjaxHitOnButtonClick(id)
	        {
				var sendData = {"action":"bringChilds","pid":id};
           		var settings = {
                type:"POST",
                dataType:"JSON",
                url:"api.php",
                data:sendData,
                success:function(response){ showResponse(response);}};
                $.ajax(settings);
	        }

    </script>
    </body>
</html>
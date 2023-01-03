<!DOCTYPE html>
<html>
  <head>

    <title>Deep Cube</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">


	<script src="./js/jquery.min.js"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="./js/easing.js"></script>
	<script type="text/javascript" src="./js/move-top.js"></script>
					<script type="text/javascript">
					jQuery(document).ready(function($) {
						$(".scroll").click(function(event){		
							event.preventDefault();
							$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
						});
					});
</script>
<script src="js/echarts.min.js"></script>
<script src="js/china.js"></script>

    <!-- Bootstrap -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
      href="/static/main.css">



    <!--[if lt IE 9]>
          <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <![endif]-->



    <!-- Bootstrap -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
      href="/static/main.css">


	<style>
        body, html{
            background-color: rgb(0, 0, 0, 0);
            position: absolute;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }
	  
        dt, dd, dl{
            margin: 0;
            padding: 0;
        }
        dt, dd{
            font-weight: 500;
            display: inline-block;
        }
        textarea{
            width: 820px; height: 50px; resize: none
        }
        #button_submit_div > div > button{
            border: none;
            background: red;
            color: white;
            padding: 4px 10px;
        }
        #button_submit_div{
            text-align: right;
        }
        .time{
            padding: 0 10px;
            color: lightgray;
        }
        ul{
            list-style: none;
            padding: 0;
        }
        ul > li:hover{
            background: deepskyblue;
            cursor: pointer;
        }
        ul > li{
            padding: 10px 10px;
            border-bottom: solid 0.5px lightgray;
            display: block;
        }
        ul > li:last-child{
            border-bottom: none;
        }
        .cmt_img, .right_box{
            display: inline-block;
            vertical-align: middle;
        }
        .avatar{
            display: block;
        }
        aside, main{
            background: white;
            vertical-align: top;
            margin-top: 50px;
            box-shadow: 2px 0 2px 0 lightgray;
            display: inline-block;
        }
        aside{
            margin-left: 20px;
            text-align: center;
            width: 300px;
        }
        main{
            padding: 20px;
            text-align: left;
            width: 900px;
        }
        .form_item{
            padding: 10px 0;
        }
        .menu > div{
            display: inline-block;
            padding: 10px 10px;
        }
        .menu > div:hover{
            background: deepskyblue;
            cursor: pointer;
        }
        .menu{
            margin: 0;
            padding: 0;
            background: white;
            position: absolute;
            width: 100%;
            text-align: center
        }
        input, textarea{
            border: solid 0.5px lightgray;
            border-radius: 3px;
        }
        input{
            padding: 4px 4px;
            height: 30px;
        }
        textarea{
            padding: 10px;
            height: 60px;
        }
    </style>



  </head>
  <body>

<?php
$conn=mysqli_connect("localhost","root","123456") or die("数据库服务器连接失败");

mysqli_query($conn,"set name utf8");

mysqli_select_db($conn,"corona_virus") or die("数据库连接失败");

$sql="SELECT * FROM `china_today_data`";


$sql1="select * from world_today_data";

$result=mysqli_query($conn,$sql);

$result1=mysqli_query($conn,$sql1);

$arr=array();

while($row2=mysqli_fetch_array($result)){
	array_push($arr,$row2);	
}

$arr3=array();

while($row4=mysqli_fetch_array($result1)){
	array_push($arr3,$row4);
}
mysqli_free_result($result);
mysqli_free_result($result1);
mysqli_close($conn);

?>

    
    
<div class="container">
  <center>
  <h2>Advanced Software Engineering Course Project Example——DeepCubeA</h2>
	<div id="program_container" class="container">
		<div id="solution_container" class="container">
			<button disabled id="first_state" type="button">&#060;&#060;</button>
			<button disabled id="prev_state" type="button">&#060;</button>
			<button disabled id="next_state" type="button">&#062;</button>
			<button disabled id="last_state" type="button">&#062;&#062;</button>
			<h4 id="solution_text">Solution:</h4>
		</div>

		<div id="cube_div" class="container" style="padding: 60px">
			<section class="cube_container">
				<div id="cube">
					<figure id="front" class="front">
					</figure>
					<figure id="back" class="back">
					</figure>
					<figure id="right" class="right">
					</figure>
					<figure id="left" class="left">
					</figure>
					<figure id="top" class="top">
					</figure>
					<figure id="bottom" class="bottom">
					</figure>
				</div>
			</section>
		</div>

		<br>

		<div id="button_container" class="container">
			<button disabled id="scramble" type="button">Scramble</button>
			<button disabled id="solve" type="button">Solve!</button>
		</div>
	</div>
  </center>
</div>

<br>
<center>
	<h4>
		Use the mouse to turn the cube. &#13;&#10;
	</h4>
	<h4>
		Turn the faces with the U/D/L/R/B/F keys.
		Hold shift to turn faces couter-clockwise.
	</h4>
	<h4>
		Press scramble to randomly scramble the cube.
		Press solve to solve the cube using deep learning!
	</h4>
</center>

<br>
<div class="well well-lg">
	<center>
	<span class="paper-year">ASE TA group. 2019</span>
	</center>
</div>



<div id="main" style="width: 1500px;height:800px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
		
		
			
			var b=<?php echo json_encode($arr3); ?>;
			
			var array1=[];
			var array2=[];
			var legenddata=[];
			for(var i=0;i<20;i++){
				array1[i]=b[i].provinceName;	
				array2[i]=b[i].currentConfirmedCount;
				var temp={};
				temp["name"]=b[i].provinceName;
				temp["Confirmed"]=b[i].currentConfirmedCount;
				temp["Dead"]=b[i].deadCount;
				legenddata[i]=temp;
			}
			//alert(legenddata[0]["Confirmed"]);
			//document.write(legenddata);
			var source=[];
			var bili=[292.9846412,283.8820177,240.3871877,209.6139308,171.9476665,171.4817775,108.6830254,108.6784247,96.60227741,86.42337647,83.12039461,78.96201618,63.60817558,60.24118193,59.53150426,58.06892456,54.69003566,54.63515352,53.29165038];
			var test=['Country','Confirmed','SQRT','Dead'];
			source[0]=test;
			//alert(source[0]);
			for(var i=1;i<20;i++){
				var temp=[];
				temp[0]=b[i-1].provinceName;
				temp[1]=b[i-1].currentConfirmedCount;
				temp[2]=bili[i-1];
				temp[3]=b[i-1].deadCount;
				//alert(temp);
				source[i]=temp;
			
				
			}
			//alert(source[0]);
			//alert(source[2]);
			
			var data=[];
			for (var i=0;i<20;i++){
				if(i<9){
					data[i]=b[i].provinceName;
				}
				if(i==9){
					data[i]='';
				}
				if(i>9){
					data[i]=b[i-1].provinceName;
				}
			}
			//alert(data.length);
		

//{name:'美国',Confirmed:85840,Dead:1296},

 option = {
	 	 


 dataset: {
    source: source
//['Country','Confirmed','SQRT','Dead'],
//['美国',85840,292.9846412,1296],
},
	toolbox: {
        show: true,//false则不显示工具栏
        feature: {
            saveAsImage: {show: true,type:'jpeg'}
        }
    },

    title: {
        text: '海外疫情玫瑰图',
        subtext: '实时疫情数据',
        x: '60%',
        y: '150',
        textStyle:
        {fontSize:27,
        fontWeight:'bold',
        fontFamily:'Microsoft YaHei',
        color:'#000'
        },
        subtextStyle:
        {
            fontStyle:'italic',
			fontSize:14
        }
    },
     legend: {
        x: '60%',//水平位置，【left\center\right\数字】
        y: '350',//垂直位置，【top\center\bottom\数字】
        align:'left',//字在图例的左边或右边【left/right】
        orient:'vertical',//图例方向【horizontal/vertical】
        icon: "circle",   //图例形状【circle\rect\roundRect\triangle\diamond\pin\arrow\none】
        textStyle://图例文字
        {
            fontFamily:'微软雅黑',
            color:'#000',
            
        },
        data: data,
		//['美国','意大利','西班牙','德国','法国','伊朗','英国','瑞士','韩国','荷兰','','奥地利','比利时','加拿大','土耳其','葡萄牙','挪威','澳大利亚','巴西','瑞典'],
        formatter: function(params)  {
            console.log('图例参数',params) 
            for (var i=0;i<legenddata.length;i++){
                  if (legenddata[i].name== params){
                      return params+"\t确诊:"+legenddata[i].Confirmed+"\t死亡:"+legenddata[i].Dead;
                     }
              }
        } 
  
     },
 
	calculable: true,
    series: [
        {
            name: '半径模式',
            type: 'pie',
            clockWise: false ,
            radius: [20, 400],
            center: ['40%', '60%'],
            roseType: 'area',
			encode: {
            itemName: 'Country',
            value: 'SQRT'
					},
            itemStyle: {
                normal: {
				color: function(params) {
                       var colorList = [
            "#a71a4f","#bc1540","#c71b1b","#d93824","#ce4018","#d15122","#e7741b","#e58b3d","#e59524","#dc9e31","#da9c2d","#d2b130","#bbd337","#8cc13f","#67b52d","#53b440","#48af54","#479c7f","#48a698","#57868c"
                        ];
                        return colorList[params.dataIndex]
                    },
                    label: {
                        position: 'inside',
						textStyle:
                        {   
                            fontWeight:'bold',
                            fontFamily:'Microsoft YaHei',
                            color:'#FAFAFA',
							fontSize:10
                        },
                        //formatter:'{b} \n{@Confirmed}例 \n死亡{@Dead}',//注意这里大小写敏感哦
						formatter : function(params) 
						{  console.log('参数列表',params) 
                            if(params.data[1]>9000)
							{return params.data[0]+'\n'+params.data[1]+"例"+'\n'+"死亡"+params.data[3]+"例";}
							else{return "";}
                                    },

                    },
                },
    },

        },
        {
            name:'透明圆圈',
            type:'pie',
            radius: [10,27],
            center: ['40%', '60%'],
            itemStyle: {
                    color: 'rgba(250, 250, 250, 0.3)',
    },
            data:[
                {value:10,name:''}
            ]
        },
        {
            name:'透明圆圈',
            type:'pie',
            radius: [10,35],
            center: ['40%', '60%'],
            itemStyle: {
                    color: 'rgba(250, 250, 250, 0.3)',
    },
            data:[
                {value:10,name:''}
            ]
        }
            ] 
    
};
        

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);



    </script>
    



<div id="main1" style="width:500px;height:500px;float:left;"></div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--script src="/static/jquery.min.js"></script-->
<script src="/static/main.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>






<main onclick="mainCLick(event)" style="text-align: left">
    <div class="form_item">
        <label>姓名：</label>
        <input id="commentator" placeholder="请输入您希望展示的名称"/>
    </div>
    <div class="form_item">
        <label class="label_img">
            <img src="avatar.png" width="25px" style="border-radius: 100%">
        </label>
        <textarea id="comment_space"
                  onkeyup="readKey(event)"
                  onclick="commentFocus(event)"
                  placeholder="请输入您要评论的内容"></textarea>
    </div>
    <div id="button_submit_div">
    </div>
    <hr/>
    <div id="comment_view">
    </div>
</main>
<script type="text/javascript">
 
    getRandomId = function () {
        return 'id'.concat(Math.floor((Math.random(10) * 10000000000000000)).toString());
    };
    getCurrentTime = function () {
        return new Date().toLocaleString();
    };
 
    var curReplyTargetTag = null;
    
    var curArr = null;
 
    var parentId = null;
 
    var commentList = [];
 
    var commentTree = {
        id:'',
        commentator: '',
        author: '',
        comment: '',
        time: '',
        reply: []
    };
 
    window.onload = function (ev) {
        // the function will be called at first while page loads
        initTreeComment();
    };
 
    initTreeComment = function () {
        var commentView = document.getElementById('comment_view');
        if (commentList.length === 0) {
            noComment(commentView)
        } else {
            haveComment(commentView, commentList)
        }
    };
 
    noComment = function (commentView) {
        commentView.style.textAlign = 'center';
        commentView.innerText = 'No comments'
    };
 
    commentFocus = function (ev) {
        ev.stopPropagation();
        document.getElementById('comment_space').focus();
        renderReplyBar();
    };
 
    renderReplyBar = function () {
 
        var commentSpace = document.getElementById('comment_space');
        var textareaLen = commentSpace.value.length;
 
        var htmlText = '';
        htmlText +=
            '<div>' +
            '  <span style="color: lightgray; margin-right: 20px">' +
            '    还可以输入' +
            '    <span id="char_count">'+ (1000 - textareaLen) +'</span>' +
            '    个字符' +
            '  </span>';
 
        if(commentSpace.placeholder.charAt(0) === '回' || textareaLen > 0) {
            htmlText += '<button id="cancel_reply" ' +
                        '        onclick="cancelReply(event, this)"' +
                        '        style="margin-right: 20px;">'
        } else {
            htmlText += '<button id="cancel_reply"' +
                        '        onclick="cancelReply(event, this)"' +
                        '        style="margin-right: 20px;display: none;">'
        }
 
        htmlText += '取消回复</button>' +
                    '<button id="submit_button">提交</button>' +
                    '</div>';
 
        document.getElementById('button_submit_div').innerHTML = htmlText;
 
        submitComment(commentSpace);
    };
 
    submitTree = function (submitButton, textareaEle) {
 
        submitButton.onclick = function (ev) {
            ev.stopPropagation();
            console.log(parentId);
            var text = textareaEle.value;
            if (text.length > 0){
                var plcHolder = textareaEle.placeholder;
                if(plcHolder.charAt(0) === '回') {
                    plcHolder = plcHolder.substring(plcHolder.indexOf(' '), plcHolder.length)
                } else {
                    curArr = commentList;
                    plcHolder = "anonymous";
                }
                var commentator = document.getElementById('commentator').value;
 
                if(commentator.trim().length === 0) {
                    alarmIfEmpSpace();
                } else {
                    commentTree = {
                        id: getRandomId(),
                        commentator: commentator,
                        author: plcHolder,
                        comment: text,
                        time: getCurrentTime(),
                        reply: []
                    };
                    curArr.push(commentTree);
                    initTreeComment();
                }
            } else {
                alarmIfEmpSpace();
            }
        }
 
    };
 
    alarmIfEmpSpace = function () {
        alert("Nothing worse than itself!")
    };
 
    submitComment = function (textarea) {
        var submitButton = document.getElementById('submit_button');
        submitTree(submitButton, textarea);
    };
 
    cancelReply = function (ev, th) {
        ev.stopPropagation();
        th.style.display = 'none';
        parentId = null;
        document.getElementById('comment_space').value = "";
        countTextareaLength();
        fillPlaceholderOfCommentSpace("请输入您要评论的内容");
 
    };
 
    countTextareaLength = function () {
        var space = document.getElementById('comment_space');
        document.getElementById('char_count').innerText = 1000 - space.value.length;
    };
 
    readKey = function (ev) {
        var space = document.getElementById('comment_space');
        document.getElementById('char_count').innerText = 1000 - space.value.length;
        if(space.value.length > 0) {
            handleCancelButton(space, 'inline-block')
        } else {
            handleCancelButton(space, 'none')
        }
    };
 
    handleCancelButton = function (textArea, status) {
        document.getElementById('cancel_reply').style.display = status;
    };
 
    commentBlur = function () {
        document.getElementById('button_submit_div').innerHTML = ''
    };
 
    haveComment = function (commentView, arr) {
 
        commentView.style.textAlign = 'left';
 
        var htmlText = '';
        arr.forEach(function (value) {
            htmlText +=
                '<ul id="'+ value.id +'" class="comment_ulist" style="">' +
                '  <li class="comment_line_box" id="'+ value.id.substring(0, 4) +'">' +
                '    <a class="cmt_img">' +
                '      <img class="avatar" src="avatar.png" width="30px" style="border-radius: 100%">' +
                '    </a>' +
                '    <div class="right_box">' +
                '      <a class="commentator">'+ value.commentator +'</a>';
 
            if (value.author !== 'anonymous') {
                htmlText +=
                    '<span style="margin: 0 10px;color: lightgray">回复</span>' +
                    '<a class="author">'+ value.author +'</a>';
            }
 
            htmlText += '<span class="time">'+ value.time +'</span>';
 
            if (value.comment.length > 10){
                htmlText += ' <span style="display: block; margin-top: 8px" class="comment">'+ value.comment.substring(0, 10) +'</span>';
            } else {
                htmlText += ' <span class="comment">'+ value.comment.substring(0, 10) +'</span>';
            }
 
            htmlText +=
                '  </div>' +
                '  <span style="float: right;" id="'+ value.id.substring(0, 7) +'">' +
                '<a id="'+ value.id.substring(0, 5) +'"' +
                '  style="border: none;display: none;margin-right: 10px;">' +
                '回复</a>';
 
            if(value.reply.length > 0) {
                htmlText += '<a id="'+ value.id.substring(0, 6) +'"' +
                            '         style="border: none;">' +
                            '  查看回复('+ value.reply.length +')</a></span></li></ul>'
            } else {
                htmlText += '</span></li></ul>';
            }
 
        });
 
        commentView.innerHTML = htmlText;
 
        showButton(arr, 1)
    };
 
    showButton = function (arr, sign) {
 
        arr.forEach(function (value) {
 
            var parent = document.getElementById(value.id);
            var broEle = document.getElementById(value.id.substring(0, 4));
            var checkReply = document.getElementById(value.id.substring(0, 6));
            var reply = document.getElementById(value.id.substring(0, 5));
 
            broEle.onmouseover = function (ev) {
                reply.style.display = 'inline-block';
            };
 
            reply.onclick = function (ev) {
                ev.stopPropagation();
                renderReplyBar();
                curReplyTargetTag = parent;
                if(sign === 1) {
                    parentId = value.id
                    curArr = value.reply;
                } else {
                    curArr = arr;
                }
                document.getElementById('cancel_reply').style.display = 'inline-block';
                var str = "回复 ".concat(value.commentator);
                fillPlaceholderOfCommentSpace(str)
            };
 
            if (value.reply.length > 0) {
 
                checkReply.onclick = function (ev) {
                    ev.stopPropagation();
                    if(checkReply.innerText.trim().charAt(0) === '查'){
                        ifHaveReply(parent, value.reply, broEle);
                        checkReply.innerText = "收起回复";
                    } else {
                        toggleBackReplies(parent);
                        checkReply.innerText = "查看回复("+ value.reply.length +")";
                    }
                };
            }
 
            broEle.onmouseleave = function (ev) {
                reply.style.display = 'none'
            };
        });
    };
 
    toggleBackReplies = function (parentTag) {
        var nodes = parentTag.childNodes;
        var len = nodes.length;
        parentTag.removeChild(nodes[len - 1]);
    };
 
    ifHaveReply = function (parentTag, arr, broEle) {
 
        var li = document.createElement("li");
        li.className = "reply_list";
        li.style.marginLeft = '42px';
        li.style.borderLeft = 'solid 5px lightgray';
 
        var htmlText = '<ul class="comment_ulist">';
 
        arr.forEach(function (value) {
            htmlText +=
                '<li class="comment_line_box" id="'+ value.id.substring(0, 4) +'"><a class="cmt_img" style="margin-left: 10px">' +
                '  <img class="avatar" src="avatar.png" width="30px" style="border-radius: 100%">' +
                '</a>' +
                '<div class="right_box">' +
                '  <a class="commentator">'+ value.commentator +'</a>' +
                '  <span style="margin: 0 10px;color: lightgray">回复</span>' +
                '  <a class="author">'+ value.author +'</a>' +
                '  <span class="time">'+ value.time +'</span>';
 
            if (value.comment.length > 10){
                htmlText += ' <span style="display: block; margin-top: 8px" class="comment">'+ value.comment.substring(0, 10) +'</span>';
            } else {
                htmlText += ' <span class="comment">'+ value.comment.substring(0, 10) +'</span>';
            }
 
            htmlText +=
                '</div>' +
                '<span style="float: right;" id="'+ value.id.substring(0, 7) +'">' +
                '<a id="'+ value.id.substring(0, 5) +'"' +
                '        style="display: none;border: none;margin-right: 10px;">' +
                '回复</a>';
 
 
            if(value.reply.length > 0) {
                console.log(value.reply.length)
                htmlText += '<a id="'+ value.id.substring(0, 6) +'"' +
                            '         style="border: none;">' +
                            '查看回复('+ value.reply.length +')</a></span></li>'
            } else {
                htmlText += '</span></li>';
            }
        });
 
        htmlText += '</ul>';
        li.innerHTML = htmlText;
        parentTag.insertBefore(li, broEle.nextSibling);
        showButton(arr, 2)
    };
 
    fillPlaceholderOfCommentSpace = function (str) {
        document.getElementById('comment_space').placeholder = str
    };
 
    mainCLick = function (ev) {
        document.getElementById('button_submit_div').innerHTML = '';
    };
</script>

<script type="text/javascript">
	var myChart = echarts.init(document.getElementById('main1'));
	
	var b=<?php echo json_encode($arr); ?>;
	
	
	window.dataList = [{
        name: b[0].provinceShortName,
        value: b[0].currentConfirmedCount
    },
    {
       name: b[1].provinceShortName,
        value: b[1].currentConfirmedCount
    },
    {
        name: b[2].provinceShortName,
        value: b[2].currentConfirmedCount
    },
    {
       name: b[3].provinceShortName,
        value: b[3].currentConfirmedCount
    },
    {
        name: b[4].provinceShortName,
        value: b[4].currentConfirmedCount
    },
    {
      name: b[5].provinceShortName,
        value: b[5].currentConfirmedCount
    },
    {
        name: b[6].provinceShortName,
        value: b[6].currentConfirmedCount
    },
    {
        name: b[7].provinceShortName,
        value: b[7].currentConfirmedCount
    },
    {
        name: b[8].provinceShortName,
        value: b[8].currentConfirmedCount
    },
    {
        name: b[9].provinceShortName,
        value: b[9].currentConfirmedCount
    },
    {
        name: b[10].provinceShortName,
        value: b[10].currentConfirmedCount
    },
    {
       name: b[11].provinceShortName,
        value: b[11].currentConfirmedCount
    },
    {
        name: b[12].provinceShortName,
        value: b[12].currentConfirmedCount
    },
    {
         name: b[13].provinceShortName,
        value: b[13].currentConfirmedCount
    },
    {
        name: b[14].provinceShortName,
        value: b[14].currentConfirmedCount
    },
    {
        name: b[15].provinceShortName,
        value: b[15].currentConfirmedCount
    },
    {
        name: b[16].provinceShortName,
        value: b[16].currentConfirmedCount
    },
    {
        name: b[17].provinceShortName,
        value: b[17].currentConfirmedCount
    },
    {
       name: b[18].provinceShortName,
        value: b[18].currentConfirmedCount
    },
    {
         name: b[19].provinceShortName,
        value: b[19].currentConfirmedCount
    },
    {
       name: b[20].provinceShortName,
        value: b[20].currentConfirmedCount
    },
    {
        name: b[21].provinceShortName,
        value: b[21].currentConfirmedCount
    },
    {
         name: b[22].provinceShortName,
        value: b[22].currentConfirmedCount
    },
    {
        name: b[23].provinceShortName,
        value: b[23].currentConfirmedCount
    },
    {
        name: b[24].provinceShortName,
        value: b[24].currentConfirmedCount
    },
    {
        name: b[25].provinceShortName,
        value: b[25].currentConfirmedCount
    },
    {
        name: b[26].provinceShortName,
        value: b[26].currentConfirmedCount
    },
    {
        name: b[27].provinceShortName,
        value: b[27].currentConfirmedCount
    },
    {
        name: b[28].provinceShortName,
        value: b[28].currentConfirmedCount
	},
    {
         name: b[29].provinceShortName,
        value: b[29].currentConfirmedCount
    },
    {
        name: b[30].provinceShortName,
        value: b[30].currentConfirmedCount
	},
    {
        name: b[31].provinceShortName,
        value: b[31].currentConfirmedCount
    },
    {
        name: b[32].provinceShortName,
        value: b[32].currentConfirmedCount
    },
    {
        name: b[33].provinceShortName,
        value: b[33].currentConfirmedCount
    }
    
];
option = {
    tooltip: {
        triggerOn: "click",
        formatter: function(e, t, n) {
            return .5 == e.value ? e.name + "：有疑似病例" : e.seriesName + "<br />" + e.name + "：" + e.value
        }
    },
    visualMap: {
        min: 0,
        max: 1000,
        left: 26,
        bottom: 40,
        showLabel: !0,
        text: ["高", "低"],
        pieces: [{
            gt: 1000,
            label: "> 1000 人",
            color: "#7f1100"
        }, {
            gte: 100,
            lte: 1000,
            label: "100 - 1000 人",
            color: "#ff5428"
        }, {
            gte: 1,
            lt: 100,
            label: "1 - 99 人",
            color: "#ff8c71"
        }, {
            gt: 0,
            lt: 1,
            label: "疑似",
            color: "#ffd768"
        }, {
            value: 0,
            color: "#ffffff"
        }],
        show: !0
    },
    geo: {
        map: "china",
        roam: !1,
        scaleLimit: {
            min: 1,
            max: 2
        },
        zoom: 1.23,
        top: 120,
        label: {
            normal: {
                show: !0,
                fontSize: "14",
                color: "rgba(0,0,0,0.7)"
            }
        },
        itemStyle: {
            normal: {
                //shadowBlur: 50,
                //shadowColor: 'rgba(0, 0, 0, 0.2)',
                borderColor: "rgba(0, 0, 0, 0.2)"
            },
            emphasis: {
                areaColor: "#f2d5ad",
                shadowOffsetX: 0,
                shadowOffsetY: 0,
                borderWidth: 0
            }
        }
    },
    series: [{
        name: "确诊病例",
        type: "map",
        geoIndex: 0,
        data: window.dataList
    }]
};
	myChart.setOption(option);
    </script>


  </body>
</html>

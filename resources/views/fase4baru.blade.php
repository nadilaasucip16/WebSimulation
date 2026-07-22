<!DOCTYPE html>
<html>

<head>

<title>
Fase 4 Blockly OOP
</title>


<meta charset="UTF-8">


<script src="https://unpkg.com/blockly/blockly.min.js"></script>



<style>


body{

font-family:Arial;
background:#f3f3f3;
padding:30px;

}



.container{

display:flex;
gap:20px;

}



.box{

background:white;
border-radius:15px;
border:1px solid #ddd;
padding:15px;

}



.left{

width:250px;

}



.center{

flex:1;

}



.right{

width:300px;

}



#blocklyDiv{

height:500px;

}



button{


padding:12px 25px;

border-radius:10px;

cursor:pointer;

margin-top:15px;

}



.run{

background:#6db56d;

color:white;

border:none;

}


.reset{

background:white;

border:1px solid #aaa;

}



</style>


</head>


<body>



<h1>

Fase 4 : Aplikasi Class Student

</h1>



<p>
Buat struktur OOP menggunakan block
</p>


<ul>

<li>Class Student</li>

<li>Private attribute nilai</li>

<li>Getter getNilai()</li>

<li>Setter setNilai()</li>

</ul>





<div class="container">





<div class="box left">


<h2>

Blok Kode

</h2>



</div>







<div class="box center">


<h2>

Workspace

</h2>



<div id="blocklyDiv"></div>



<button onclick="runCode()" class="run">

Run →

</button>



<button onclick="resetWorkspace()" class="reset">

Reset

</button>



</div>









<div class="box right">


<h2>

Hasil

</h2>



<pre id="result"></pre>



</div>






</div>








<xml id="toolbox" style="display:none">


<category name="OOP">


<block type="oop_class"></block>


<block type="oop_attribute"></block>


<block type="oop_private"></block>


<block type="oop_getter"></block>


<block type="oop_setter"></block>



</category>


</xml>

<script src="{{asset('js/blockly/oop-blocks.js')}}"></script>
<script src="{{asset('js/blockly/oop-generator.js')}}"></script>

<script>



let workspace = Blockly.inject(

'blocklyDiv',

{

toolbox:

document.getElementById('toolbox')

}

);






function runCode(){


let hasil = generateCode(workspace);



document.getElementById(
"result"
)
.innerText = hasil;


}





function resetWorkspace(){


workspace.clear();


document.getElementById(
"result"
)
.innerText="";


}





</script>





</body>


</html>

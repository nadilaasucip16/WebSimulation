

// =====================
// BLOCK CLASS
// =====================


Blockly.Blocks['oop_class'] = {


init:function(){


this.appendDummyInput()

.appendField("Class")

.appendField(

new Blockly.FieldTextInput(
"Student"
),

"NAME"

);


this.setNextStatement(true);

this.setColour("#8CAF6D");


}

};





// =====================
// ATTRIBUTE
// =====================


Blockly.Blocks['oop_attribute']={


init:function(){


this.appendDummyInput()


.appendField("Attribute")

.appendField(

new Blockly.FieldTextInput(
"nilai"
),

"NAME"

)

.appendField("=")

.appendField(

new Blockly.FieldTextInput(
"0"
),

"VALUE"

);



this.setPreviousStatement(true);

this.setNextStatement(true);


this.setColour("#8A6BBE");


}


};





// =====================
// PRIVATE
// =====================


Blockly.Blocks['oop_private']={


init:function(){


this.appendDummyInput()

.appendField("Private");


this.setPreviousStatement(true);

this.setNextStatement(true);


this.setColour("#5479B8");


}


};




// =====================
// PUBLIC
// =====================


Blockly.Blocks['oop_public']={


init:function(){


this.appendDummyInput()

.appendField("Public");


this.setPreviousStatement(true);

this.setNextStatement(true);


this.setColour("#E4BF50");


}


};






// GETTER

Blockly.Blocks['oop_getter']={


init:function(){


this.appendDummyInput()

.appendField("Getter")

.appendField(

new Blockly.FieldTextInput(
"getNilai"
),

"NAME"

);


this.setPreviousStatement(true);

this.setNextStatement(true);


this.setColour("#CE9958");


}

};






// SETTER


Blockly.Blocks['oop_setter']={


init:function(){


this.appendDummyInput()

.appendField("Setter")

.appendField(

new Blockly.FieldTextInput(
"setNilai"
),

"NAME"

);


this.setPreviousStatement(true);

this.setNextStatement(true);


this.setColour("#C57C7C");


}

};





// ====================
// TOOLBOX
// ====================


let toolbox = `


<xml>


<category name="OOP">


<block type="oop_class"></block>


<block type="oop_attribute"></block>


<block type="oop_private"></block>


<block type="oop_public"></block>


<block type="oop_getter"></block>


<block type="oop_setter"></block>


</category>



</xml>


`;





// CREATE WORKSPACE


let workspace = Blockly.inject(

'blocklyDiv',

{

toolbox:toolbox

}

);





// =====================
// RUN
// =====================


function runCode(){



let blocks =
workspace.getAllBlocks();



let output="";



blocks.forEach(block=>{


switch(block.type){



case "oop_class":


output +=

"class "

+
block.getFieldValue("NAME")

+
" {\n";


break;



case "oop_attribute":


output +=

"private int "

+
block.getFieldValue("NAME")

+
" = "

+
block.getFieldValue("VALUE")

+
";\n";


break;




case "oop_private":


output +=

"private\n";


break;



case "oop_public":


output +=

"public\n";


break;




case "oop_getter":


output +=

"public int "

+
block.getFieldValue("NAME")

+
"(){\n return nilai;\n}\n";


break;




case "oop_setter":


output +=

"public void "

+
block.getFieldValue("NAME")

+
"(int n){\n nilai=n;\n}\n";


break;



}


});



output += "\n}";



document.getElementById(
"result"
)
.innerText =
output;



}





function resetWorkspace(){


workspace.clear();


document.getElementById(
"result"
)
.innerText="";


}

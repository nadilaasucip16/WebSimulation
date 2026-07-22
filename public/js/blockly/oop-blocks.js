// CLASS


Blockly.Blocks['oop_class'] = {


init:function(){


this.appendDummyInput()

.appendField("Class")

.appendField(

new Blockly.FieldTextInput(
""
),

"NAME"

);



this.appendStatementInput("BODY");


this.setColour(120);


}

};







// ATTRIBUTE


Blockly.Blocks['oop_attribute']={


init:function(){


this.appendDummyInput()


.appendField("Attribute")


.appendField(

new Blockly.FieldTextInput(
""
),

"NAME"

)


.appendField("=")


.appendField(

new Blockly.FieldTextInput(
""
),

"VALUE"

);



this.setPreviousStatement(true);


this.setNextStatement(true);


this.setColour(260);



}

};








// PRIVATE


Blockly.Blocks['oop_private']={


init:function(){


this.appendDummyInput()

.appendField("Private");



this.setPreviousStatement(true);


this.setNextStatement(true);



this.setColour(210);



}

};










// GETTER


Blockly.Blocks['oop_getter']={


init:function(){


this.appendDummyInput()

.appendField("Getter")

.appendField(

new Blockly.FieldTextInput(
""
),

"NAME"

);



this.setPreviousStatement(true);


this.setNextStatement(true);



this.setColour(40);



}

};









// SETTER


Blockly.Blocks['oop_setter']={


init:function(){


this.appendDummyInput()

.appendField("Setter")

.appendField(

new Blockly.FieldTextInput(
""
),

"NAME"

);



this.setPreviousStatement(true);


this.setNextStatement(true);



this.setColour(330);



}

};

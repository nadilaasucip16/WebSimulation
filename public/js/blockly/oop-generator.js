function generateCode(workspace) {

    let code = "";

    let blocks = workspace.getTopBlocks(true);

    blocks.forEach(block => {

        if (block.type === "oop_class") {

            let className = block.getFieldValue("NAME");

            code += "class " + className + ":\n";

            let child = block.getInputTargetBlock("BODY");

            if (child == null) {
                code += "    pass\n";
            }

            while (child) {
                code += generateBlock(child);
                child = child.getNextBlock();
            }

            code += "\n";
        }

    });

    return code;
}

function isInsidePrivate(block) {

    let parent = block.getParent();

    while (parent) {

        if (parent.type === "oop_private") {
            return true;
        }

        parent = parent.getParent();
    }

    return false;
}

function generateBlock(block) {

    let code = "";

    let isPrivate = isInsidePrivate(block);

    let prefix = isPrivate ? "__" : "";

    switch (block.type) {

        case "oop_private":

            code += "    # private attribute\n";

            let child = block.getInputTargetBlock("BODY");

            while (child) {
                code += generateBlock(child);
                child = child.getNextBlock();
            }

            break;

        case "oop_attribute":

            let name = block.getFieldValue("NAME");
            let value = block.getFieldValue("VALUE");

            code +=
                "    def __init__(self):\n" +
                "        self." + prefix + name + " = " + value + "\n\n";

            break;

        case "oop_getter":

            let getter = block.getFieldValue("NAME");

            let attrGet = getter
                .replace(/^get/i, "")
                .toLowerCase();

            code +=
                "    def " + getter + "(self):\n" +
                "        return self." + prefix + attrGet + "\n\n";

            break;

        case "oop_setter":

            let setter = block.getFieldValue("NAME");

            let attrSet = setter
                .replace(/^set/i, "")
                .toLowerCase();

            code +=
                "    def " + setter + "(self, nilai):\n" +
                "        self." + prefix + attrSet + " = nilai\n\n";

            break;
    }

    return code;
}

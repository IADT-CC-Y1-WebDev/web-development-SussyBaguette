import Animal from "./Animal.js";

class Feline extends Animal{ 

    constructor(_name, _age){
        super(_name, _age);
    }

    roam(){
        console.log("Roaming: Im roaming alone.")
    }
}

export default Feline;
import Canine from "./Canine.js";


class Dog extends Canine {

    constructor(_name, _age){
        super(_name, _age);
    }

    makeNoise(){
        console.log("WoooFFF >:3");
    }
}

export default Dog;
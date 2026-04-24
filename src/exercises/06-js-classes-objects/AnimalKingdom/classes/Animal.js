class Animal {

    constructor(_name, _age){
        this.name = _name;
        this.age = _age;
    }

    sleep(){
        console.log("ZZZzzZZZZzz");
    }

    makeNoise(){
        console.log("Noisess...");

    }

    roam(){
        console.log("Roam roam roam :D");
    }
}

export default Animal;
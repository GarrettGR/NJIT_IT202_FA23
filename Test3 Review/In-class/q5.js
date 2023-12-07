class Rectangle {
  constructor(width, height) {
    this.width = width;
    this.height = height;
  }
  getArea() {
    return this.width * this.height;
  }
  getPerimeter() {
    return 2 * (this.width + this.height);
  }
}

const rectangle = new Rectangle(5, 10);
document.write("Area: " + rectangle.getArea() + "<br>");
document.write("Perimeter: " + rectangle.getPerimeter());


// ! --------------------------------------------------------------

// TODO: make static types?

// ? correct static types below:

/*
class Rectangle {
    width: number;
    height: number;

    constructor(width: number, height: number) {
        this.width = width;
        this.height = height;
    }

    getArea(): number {
        return this.width * this.height;
    }

    getPerimeter(): number {
        return 2 * (this.width + this.height);
    }
}

const rectangle = new Rectangle(5, 10);
console.log("Area: " + rectangle.getArea());
console.log("Perimeter: " + rectangle.getPerimeter());
*/
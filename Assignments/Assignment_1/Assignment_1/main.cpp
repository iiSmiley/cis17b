/* 
 * File:   Assignment 1: Dice Class
 * 
 * Author: Omar Alkendi
 *
 * Created on September 28, 2019, 5:43 PM
 * 
 * Purpose: 
 * 
 */
#include <cstdlib>
#include <iostream>
#include <ctime>
using namespace std;

class Dice {
    private:
        static const int MAX_SIDES=6;
        static const int MIN_SIDES=0;
        
        int faceValue;
        string name;
        string pictureName;
        void setName();
        void setPictureName ();
    public:
        Dice();
        Dice(int);
        ~Dice();
        int getFaceValue (){return this->faceValue;}
        string getPictureName () {return this->pictureName;}
        void setFaceValue(int);
        void roll();
        void display();
};
Dice::Dice() {
  this->faceValue = 0;
  this->name = "";
  this->pictureName = "";
};
Dice::Dice(int faceValue){
    this->faceValue = faceValue;
    setName();
    setPictureName();
};
Dice::~Dice(){
};
void Dice::setName() {
    switch(this->faceValue){
        case 0:  this->name="One";  break;
        case 1:  this->name="Two";  break;
        case 2:  this->name="Three";break;
        case 3:  this->name="Four"; break;
        case 4:  this->name="Five"; break;
        case 5:  this->name="Six";  break;
        default: this->name="Bad Value";
    }
};
void Dice::setPictureName() {
    this->pictureName="Faces/"+this->name+".jpg";
};
void Dice::setFaceValue(int faceValue) {
    this->faceValue = faceValue;
    setName();
    setPictureName();
};
void Dice::roll() {
    int myRandom;
    myRandom=rand()%6;
    this->faceValue = myRandom;
    setName();
    setPictureName();
    display();
};
void Dice::display(){
    cout << "Face value: " << this->faceValue << endl;
    cout << "Face name : " << this->name << endl;
    cout << "<img src="<<this->pictureName<<" />" << endl;
}
int main() {

    int sides = 6;
    Dice* d = new Dice[sides];
    for(int i=0; i<sides; i++)
    {
        d[i].setFaceValue(i);
        d[i].display();
    }
    delete[] d;
    
    return 0;
}


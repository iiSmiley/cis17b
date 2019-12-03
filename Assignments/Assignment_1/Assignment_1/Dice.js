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

var MAXNUM=6;
var MINNUM=0;
function Dice(number) {
        if(number>=MINNUM&&number<MAXNUM){
        this.faceValue=number;
        this.setName();
        this.setPict();
    }else{
        this.number=-1;
        this.faceVal=-1;
        this.name="none";
        this.picture="none";
    }
};

Dice.prototype.setName=function() {
    var num = this.number;
        switch(this.number){
        case 0:  this.name="Ace";  break;
        case 1:  this.name="Two";  break;
        case 2:  this.name="Three";break;
        case 3:  this.name="Four"; break;
        case 4:  this.name="Five"; break;
        case 5:  this.name="Six";  break;
        default: this.name="Bad Value";
    }
};

Dice.prototype.setPict=function() {
    this.picture ="Faces/"+this.name+".jpg";
};

Dice.prototype.display=function() {
    document.write("<img src="+this.picture+" />");
    document.write("<br/>Name = "+this.name);
    document.write("<br/><br/>");
};


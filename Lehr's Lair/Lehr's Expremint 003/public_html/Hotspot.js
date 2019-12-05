/*
 * Author:      Omar Alkendi
 * Purpose:     Hotspot class that will be utilized to connect differnt pages
 */

//Constructor for the Hotspot class
function Hotspot(id,coords){
    var nArgs=arguments.length;//The number of arguments passed to the function
    if(nArgs===2) {
        this.id=id;
        this.coords=coords;
    }
    else if(nArgs===1){
        this.id=id;
        this.coords=[];
    }
    else{
        this.id=0;
        this.coords=[];
    }
};
Hotspot.prototype.setId=function(id){
    this.id=id;
};
Hotspot.prototype.pushCoords=function(x,y){
    this.coords.push(x);
    this.coords.push(y);
};
Hotspot.prototype.getId=function(){
    return this.id;
};
//The output function returns a string of coordinates. Ex: 445,555,597,649
Hotspot.prototype.getCoordsStr=function(){
    var locStr="";
    for(var i=0; i<this.coords.length; i++){
        locStr+=this.coords[i];
        
        if(i+1<this.coords.length) {
            locStr+=",";
        }
    }
    return locStr;
};
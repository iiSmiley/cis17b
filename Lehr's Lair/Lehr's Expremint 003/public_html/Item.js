/*
 * Author:      Omar Alkendi
 * Purpose:     The item class is better and safer way to handle the items than structs.
 */
//Constructor for the Item class
function Item(itemId,itemName, itemStatus) {
    var nArgs=arguments.length;//The number of arguments passed to the function
    if(nArgs===3) {
        this.itemId=itemId;
        this.itemName=itemName;
        this.itemStatus=itemStatus;
    }
    //If the hotspots and items will be added later
    else if(nArgs===2) {
        this.itemId=itemId;
        this.itemName=itemName;
        this.itemStatus=false;
    }
    else {
        this.itemId=0;
        this.itemName="";
        this.itemStatus=false;
    }    
};
Item.prototype.setId=function(itemId) {
    this.itemId=itemId;
};
Item.prototype.setName=function(itemName) {
    this.itemName=itemName;
};
Item.prototype.setStatusFalse=function() {
    this.itemStatus=false;
};
Item.prototype.setStatusTrue=function() {
    this.itemStatus=true;
};
Item.prototype.getId=function() {
    return this.itemId;
};
Item.prototype.getName=function() {
    return this.itemName;
};
Item.prototype.getStatus=function() {
    return this.itemStatus;
};
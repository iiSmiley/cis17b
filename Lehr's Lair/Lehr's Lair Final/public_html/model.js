/*
 * Author:      Omar Alkendi
 * Purpose:     The model class contains the bare-bones of Lehr's Lair, items and pages.
 *              The model does not contain any logical structure that are related to the game. 
 */
function model(pages, items) {
    var nArgs=arguments.length;//The number of arguments passed to the function
    if(nArgs===2) {
        this.pages=pages;
        this.items=items;
        this.currentPage=0;
        this.startTime= new Date().getTime();
        this.endTime=0;
        this.lightStatus=false;
    }
    else {
        this.pages=[];
        this.items=[];
        this.currentPage=1;
        this.startTime=new Date().getTime();
        this.endTime=0;
        this.lightStatus=false;
    }
};
model.prototype.setLightStatusOn=function() {
    this.lightStatus=true;
};
model.prototype.setLightStatusOff=function() {
    this.lightStatus=false;
};
model.prototype.getLightStatus=function() {
    return this.lightStatus;
};
model.prototype.getCurrentPage=function() {
    return this.currentPage;
}
model.prototype.pushItem=function(item) {
    this.items.push(item);
};
model.prototype.pushPage=function(page) {
    this.pages.push(page);
};
model.prototype.setCurrentPage=function(pageId) {
    this.currentPage=pageId;
};
model.prototype.findPageIndex=function() {
    for(var i=0; i<this.pages.length; i++) {
        if(this.pages[i].getPageId()===this.currentPage) {
            return i;
        }
    }
};
model.prototype.findItemIndex=function(itemId) {
    for(var i=0; i<this.items.length; i++) {
        if(this.items[i].getId()===itemId) {
            return i;
        }
    }
};
model.prototype.setItemStatusTrue=function(itemId) {
    for(var i=0; i<this.items.length; i++) {
        if(this.items[i].getId===itemId) {
            this.items[i].setStatusTrue();
        }
    }
    for(var p=0; p<this.pages.length; p++) {
        for(var i=0; i<this.pages[p].pageItems.length; i++)
        {
            if(this.pages[p].pageItems[i].getId()===itemId) {
                this.pages[p].pageItems[i].setStatusTrue();
            }
        }
    }
};
model.prototype.getItemStatus=function(itemId) {
    var i = this.findItemIndex(itemId);
    return this.items[i].getStatus();
};
model.prototype.getPagePic=function() {
    var i=this.findPageIndex();
    /*for(var i=0; i<this.pages.length; i++) {
        if(this.pages[i].getPageId()===this.currentPage) 
            index = i;
        }*/
    var picStr="";
    if(this.lightStatus===false) {
        picStr +="Car_Dark/";
    }
    else {
        picStr +="Car_Lit/";
    }
        picStr += this.pages[i].getPicName();
    return picStr;
};
model.prototype.getPagesHotspots=function() {
    var i=this.findPageIndex();
    return this.pages[i].getPageHotspotsStr();
};
model.prototype.getItemsHotspots=function() {
    var i=this.findPageIndex();
    return this.pages[i].getItemHotspotsStr();
};
model.prototype.setEndTime=function() {
    this.endTime = new Date().getTime();
};
model.prototype.getGameTime=function() {
    return (this.endTime-this.startTime)/1000;
};
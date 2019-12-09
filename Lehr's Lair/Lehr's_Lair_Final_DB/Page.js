/*
 * Author:      Omar Alkendi
 * Purpose:     Page class that will be utilized to generate different page
 */
//Constructor for the Page class
function Page(pageId, pageName, itemsHotspots, pageItems, pagesHotspot) {
    var nArgs=arguments.length;//The number of arguments passed to the function
    if(nArgs===4) {
        this.pageId=pageId;
        this.pageName=pageName;
        this.itemsHotspots=itemsHotspots;
        this.pagesHotspots=pagesHotspot;
        this.pageItems=pageItems;
    }
    //If the hotspots and items will be added later
    else if(nArgs===2) {
        this.pageId=pageId;
        this.pageName=pageName;
        this.itemsHotspots=[];
        this.pageItems=[];
        this.pagesHotspots=[];
    }
    else {
        this.pageId=0;
        this.pageName="";
        this.itemsHotspots=[];
        this.pageItems=[];
        this.pagesHotspots=[];
    }
};
Page.prototype.setId=function(pageId){
    this.pageId=pageId;
};
Page.prototype.setName=function(pageName){
    this.pageName=pageName;
};
Page.prototype.addItemHotspot=function(hotspotId, x, y){
    var a = new Hotspot(hotspotId);
    a.pushCoords(x,y);
    this.itemsHotspots.push(a);
};
Page.prototype.pushItemHotspot=function(hotspot){
    this.itemsHotspots.push(hotspot);
};
Page.prototype.addPageHotspot=function(hotspotId, x, y){
    var a = new Hotspot(hotspotId);
    a.pushCoords(x,y);
    this.pagesHotspots.push(a);
};
Page.prototype.pushPageHotspot=function(hotspot){
    this.pagesHotspots.push(hotspot);
};
Page.prototype.addItem=function(itemId, itemName) {
    var a = new Item(itemId, itemName);
    this.pageItems.push(a);
};
Page.prototype.pushItem=function(item) {
    this.pageItems.push(item);
};
Page.prototype.getPageId=function() {
    return this.pageId;
};
Page.prototype.getPicName=function() {
    var picStr=""+this.pageName;

    for(var i=0; i<this.pageItems.length; i++){
        picStr+=this.pageItems[i].getStatus();
    }
    return picStr+".png";
};
Page.prototype.getItemHotspotsStr=function(){
    var itemsHotspotStr ="";
    for(var i=0; i<this.pageItems.length; i++) {
        //document.getElementById("demo1").innerHTML = "test for 1";
        for(var j=0; j<this.itemsHotspots.length;j++){
            //document.getElementById("demo1").innerHTML = "test for 2";
            if(this.pageItems[i].getId()===this.itemsHotspots[j].getId()){
                //document.getElementById("demo1").innerHTML = "test if 1";
                if(this.pageItems[i].getStatus()===false)
                {
                    //document.getElementById("demo1").innerHTML = "test if 2";
                    //outputs: <area shape="rect" coords="633,115,931,244" alt="Glove" onclick="function">
                    itemsHotspotStr += "<area shape='rect' coords='"+this.itemsHotspots[j].getCoordsStr()+"' alt='"+this.pageItems[i].getName()+"' onclick='function"+this.pageItems[i].getId()+"()'>";
                    //itemsHotspotStr += "<area shape='rect' coords='"+this.itemsHotspots[j].getCoordsStr()+"' alt='"+this.pageItems[i].getName()+"' onclick='alert()'>";
                }
            }
        }
    }
    return itemsHotspotStr;
};
Page.prototype.getPageHotspotsStr=function() {
    var pagesHotspotsStr="";
    for(var i=0; i<this.pagesHotspots.length; i++)
    {
        //pagesHotspotsStr += "<area shape='rect' coords='"+this.pagesHotspots[i].getCoordsStr()+"' onclick='alert()'>";
        pagesHotspotsStr += "<area shape='rect' coords='"+this.pagesHotspots[i].getCoordsStr()+"' onclick='function"+this.pagesHotspots[i].getId()+"()'>";
    }
    return pagesHotspotsStr;
};
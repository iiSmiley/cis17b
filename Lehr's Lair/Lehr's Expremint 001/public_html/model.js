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
        this.startTime=getTime();
        this.endTime=0;
    }
    else {
        this.pages=[];
        this.items=[];
        this.currentPage=0;
        this.startTime=getTime();
        this.endTime=0;
    }
};
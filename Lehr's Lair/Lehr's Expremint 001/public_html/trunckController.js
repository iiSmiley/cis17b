/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    window.onload = initiate;
    
    //Model initiation
    var level = new model();
    function initiate() {
                //Items Hotspots initiation:
                //Batteries
                var a0 = new Hotspot(30);
                a0.pushCoords(475,375);
                a0.pushCoords(599,428);
                //Flashlight
                var a1 = new Hotspot(31);
                a1.pushCoords(750,375);
                a1.pushCoords(848,482);
                //Wire cutters
                var a2 = new Hotspot(32);
                a2.pushCoords(75,599);
                a2.pushCoords(212,667);
                //Blue wire
                var a3 = new Hotspot(33);
                a3.pushCoords(446,536);
                a3.pushCoords(602,599);
                //Green Wire
                var a4 = new Hotspot(34);
                a4.pushCoords(604,691);
                a4.pushCoords(749,604);
                //Red Wire
                var a5 = new Hotspot(35);
                a5.pushCoords(166,524);
                a5.pushCoords(368,576);
                //Door Handle
                var a6 = new Hotspot(36);
                a6.pushCoords(747,371);
                a6.pushCoords(846,481);
                
                //Pages Hotspots Initiation
                //trunk->frontSeat
                var a7 = new Hotspot(10);
                a7.pushCoords(427,231);
                a7.pushCoords(499,281);
                //frontSeat->passengerDoor
                var a8 = new Hotspot(100);
                a8.pushCoords(939,253);
                a8.pushCoords(1028,448);
                //frontSeat->middleConsole
                var a9 = new Hotspot(101);
                a9.pushCoords(459,473);
                a9.pushCoords(581,710);
                //frontSeat->underWheel
                var a10 = new Hotspot(102);
                a10.pushCoords(120,290);
                a10.pushCoords(413,436);
                //frontSeat->gloveBox
                var a11 = new Hotspot(103);
                a11.pushCoords(650,125);
                a11.pushCoords(920,250);
                //backArrow
                var a12 = new Hotspot(999);
                a12.pushCoords(10,652);
                a12.pushCoords(141,710);
                
                //Items initiation
                var i0 = new Item(30,"batteries", false);
                var i1 = new Item(31,"flashlight", false);
                var i2 = new Item(32,"wireCutter", false);
                var i3 = new Item(33,"blueWire", false);
                var i4 = new Item(34,"greenWire", false);
                var i5 = new Item(35,"redwire", false);
                var i6 = new Item(36,"doorHandle", false);
                
                //Pages initiation
                var p0 = new Page(1,"trunk");
                var p1 = new Page(10,"frontSeat");
                var p2 = new Page(100,"door");
                var p3 = new Page(101,"middleConsole");
                var p4 = new Page(102,"underWheel");
                var p5 = new Page(103,"gloveBox");
                var p6 = new Page(999,"backArrow");
                
                //Shoving items into their specific pages
                //wireCutter into trunk page
                p0.pushItem(i2);
                //flashlight int middleConsole page
                p3.pushItem(i1);
                //batteries into gloveBox page
                p5.pushItem(i0);
                //doorHandle into dooe page
                p2.pushItem(i6);
                //Blue &Green &Red wires into underWheel page
                p4.pushItem(i3);
                p4.pushItem(i4);
                p4.pushItem(i5);
                
                //Shoving items hotspots into their specific pages
                //wireCutter into trunk
                p0.pushItemHotspot(a2);
                //flashlight into middleConsole
                p3.pushItemHotspot(a1);
                //batteries into gloveBox
                p5.pushItemHotspot(a0);
                //doorHandle into door
                p2.pushItemHotspot(a6);
                //Blue &Green &Red wires into underWheel
                p4.pushItemHotspot(a3);
                p4.pushItemHotspot(a4);
                p4.pushItemHotspot(a5);
                
                //Shoving transition hotspots into their specific pages
                //trunk->fronSeat
                p0.pushPageHotspot(a7);
                //frontSeat->passengerDoor
                p1.pushPageHotspot(a8);
                //frontSeat->middleConsole
                p1.pushPageHotspot(a9);
                //frontSeat->underWheel
                p1.pushPageHotspot(a10);
                //frontSeat->gloveBox
                p1.pushPageHotspot(a11);
                //frontSeat->trunk
                p1.pushPageHotspot(a12);
                //door->frontSeat
                p2.pushPageHotspot(a12);
                //middleConsole->frontSeat
                p3.pushPageHotspot(a12);
                //underWheel->frontSeat
                p4.pushPageHotspot(a12);
                //gloveBox->frontSeat
                p5.pushPageHotspot(a12);
                
                
                
                //Shoving level items
                level.pushItem(i0);
                level.pushItem(i1);
                level.pushItem(i2);
                level.pushItem(i3);
                level.pushItem(i4);
                level.pushItem(i5);
                level.pushItem(i6);
                
                //Shoving level pages
                level.pushPage(p0);
                level.pushPage(p1);
                level.pushPage(p2);
                level.pushPage(p3);
                level.pushPage(p4);
                level.pushPage(p5);
                level.pushPage(p6);
            }
    /*        
    function cleanPageItems() {
                    document.getElementById("pageItems").innerHTML = "";
            }
    
    function cleanPageHotspots() {
                    document.getElementById("pageItems").innerHTML = "";
    }
    
    function cleanPageHotspots() {
        document.getElementById("pageItems").innerHTML = "";
        document.getElementById("pageItems").innerHTML = "";
    }
    function updatePage() {
        var image = document.getElementById("pageImage");
        image.src = level.getPagePic();
    }
            
    function updatePageHotspots () {
        document.getElementById("pageHotspots").innerHTML = level.getPagesHotspots();
        document.getElementById("pageItems").innerHTML = level.getItemsHotspots();
    }*/
    
    function update () {
        var image = document.getElementById("pageImage");
        image.src = level.getPagePic();
        document.getElementById("pageHotspots").innerHTML = level.getPagesHotspots();
        document.getElementById("pageItems").innerHTML = level.getItemsHotspots();
    }
    function function10() {
                level.setCurrentPage(10);
                update();
            }
            function function100() {
                level.setCurrentPage(100);
                update();
            }
            function function101() {
                level.setCurrentPage(101);
                update();
            }
            function function102() {
                level.setCurrentPage(102);
                update();
            }
            function function103() {
                level.setCurrentPage(103);
                update();
            }
            function function999() {
                if(99< level.getCurrentPage() && level.getCurrentPage()<104) {
                    level.setCurrentPage(10)
                }
                else {
                    level.setCurrentPage(1);
                }
                
                update();
            }
            
    function function30() {
        
    }
    
    function function31() {
        
    }
    function function32() {
        
    }
    function function33() {
        
    }
    function function34() {
        
    }
    function function35() {
        
    }
    function function36() {
        
    }


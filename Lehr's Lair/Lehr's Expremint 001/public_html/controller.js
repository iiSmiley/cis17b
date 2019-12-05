/*
 * Author:      Omar Alkendi
 * Purpose:     The controller is a function that takes the value of the hot spot
 *              and modifies the view accordingly.
 */
            //window.onload = initiate; 
            
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
                
                //Model initiation
                var level = new model();
                
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
                
               
            function myFunction1() {
                document.getElementById("demo0").innerHTML = level.getLightStatus();
            }
            function myFunction2() {
                document.getElementById("demo0").innerHTML = level.getPagePic();
            }
            function updatePage() {
                var image = document.getElementById("pageImage");
                image.src = level.getPagePic();
            }
            function myFunction4() {
                document.getElementById("demo0").innerHTML = i1.getName()+"_"+i1.getStatus();
            }
            function myFunction5() {
                document.getElementById("demo0").innerHTML = p.getPicName();
            }
            function myFunction6() {
                document.getElementById("pageItems").innerHTML = p.getItemHotspotsStr();
            }
            function myFunction7() {
                //document.getElementById("demo2").innerHTML = "function7";
                if(p.pageItems[0].getStatus()===false) {
                    document.getElementById("demo2").innerHTML = "settingTrue";
                    p.pageItems[0].setStatusTrue();
                }
                else {
                    document.getElementById("demo2").innerHTML = "settingFalse";
                    p.pageItems[0].setStatusFalse();
                }
            }
            function cleanPageItems() {
                    document.getElementById("pageItems").innerHTML = "";
            }
            function cleanPageHotspots() {
                    document.getElementById("pageItems").innerHTML = "";
            }
            function changeImage() {
                var image = document.getElementById("pageImage");
                if(image.getAttribute("src")==="Car_Lit/trunkfalse.png") {
                    image.src = "Car_Lit/trunktrue.png";
                }
                else {
                    image.src = "Car_Lit/trunkfalse.png";
                }
            }
            /*
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
                
                //Model initiation
                var level = new model();
                
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
            */
            
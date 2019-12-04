/*
 * Author:      Omar Alkendi
 * Purpose:     The controller is a function that takes the value of the hot spot
 *              and modifies the view accordingly.
 */
var a1 = new Hotspot(30);
            a1.pushCoords(242,545);
            a1.pushCoords(666,777);
            var a2 = new Hotspot(31);
            a2.pushCoords(555,666);
            a2.pushCoords(999,000);
            var i1 = new Item(30,"Batteries", false);
            var i2 = new Item(31,"Flashlight", false);
            var p = new Page(1,"trunk");
            p.pushItem(i1);
            p.pushItemHotspot(a1);
            p.pushItemHotspot(a2);
            p.pushItem(i2);
            function myFunction1() {
                document.getElementById("demo0").innerHTML = a1.getCoordsStr();
            }
            function myFunction2() {
                document.getElementById("demo0").innerHTML = a1.getId();
            }
            function myFunction3() {
                document.getElementById("demo0").innerHTML = "<h1 color='red'>"+ a1.getCoordsStr() + "</h1>";
            }
            function myFunction4() {
                document.getElementById("demo0").innerHTML = i1.getName()+"_"+i1.getStatus();
            }
            function myFunction5() {
                document.getElementById("demo0").innerHTML = p.getPicName();
            }
            function myFunction6() {
                document.getElementById("demo0").innerHTML = p.getItemHotspotsStr();
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
            
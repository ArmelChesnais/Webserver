$().ready(function() {
          function cardPopup(id, element) {
          //document.getElementById("popup").innerHTML = "test";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
          
          //document.getElementById("popup").innerHTML = "readyState: " + this.readyState + " status: " + this.status;
          if (this.readyState == 4 && this.status == 200) {
          //myFunction(this, i);
          var newpos = findPos(element);
          var popupElement = document.getElementById("popup");
          popupElement.innerHTML = this.responseText;
          newpos[1] += element.clientHeight;
          popupElement.style.top = "" + newpos[1] + "px";
          popupElement.style.left = "" + newpos[0] + "px";
          popupElement.style.display = "block";
          }
          }
          xmlhttp.open("GET", "cardpopup.php?ID="+id, true);
          xmlhttp.send();
          };
          
          function hidePopup() {
          document.getElementById("popup").style.display = "none";
          };
          
          function findPos(obj) {
          var curleft = curtop = 0;
          if (obj.offsetParent) {
          do {
          curleft += obj.offsetLeft;
          curtop += obj.offsetTop;
          } while (obj = obj.offsetParent);
          return [curleft,curtop];
          }
          };

});

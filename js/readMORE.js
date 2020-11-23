
    var acc = document.getElementsByClassName("readmore1");
    var imgclass = document.getElementById("caret");
    var shortcontent = document.getElementsByClassName("shortcontent");
    // var readmore = document.getElementsByClassName("readmore1");
    
    var i;
    var j;
    var flag=false;
    
    
    for (i = 0; i < acc.length; i++) {
       // console.log(i);
      acc[i].addEventListener("click", function() {
        console.log('works');
        // console.log(i);
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");
        this.getElementsByTagName('img')[0].classList.toggle('rotate');
    var read= this.getElementsByClassName("read");
        var sh = this.previousElementSibling;
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        //   $('.read').click(function(){
            sh.style.display = "block";
        $(read).text("read More..");
        // });
        } else {
    
    
          panel.style.display = "block";
          sh.style.display = "none";
        
                    $(read).text("Read LESS");
                  
           
            
        //   readmore.style.display = "none";
        }
      });
    }
    
    
    function toggleDropList(node) {
        imgclass.onclick = function(){
            this.classList.toggle('rotate');
                    // $(read).text("read More..");
        }
    }

    
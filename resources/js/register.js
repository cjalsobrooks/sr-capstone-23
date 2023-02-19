
            // --------Add extra volunteer data fields logic------------------------

            
            // enables/disables group number input field when checkbox is clicked
            document.getElementById('isgroup').addEventListener('change', function() {
                document.getElementById('group_size').disabled = document.getElementById('isgroup').checked ? false : true;
                if(!document.getElementById('isgroup').checked) {
                    group_size.setAttribute('value', '0');
                }
            });

            document.getElementById('group_size').addEventListener('selectionchange', modifyFields());

            var lastGrpNum = 0;

            // this doesnt work yet so dont even worry about it
            function modifyFields() {
                let num = document.getElementById('group_size').value;              // number of volunteers in grp
                let container = document.getElementById('container');               // place where elements should insert
                let current_excess = container.childElementCount - (num - 1);       // number of ADDITIONAL fields to add
                let volSec = document.getElementById('volinfo');                    // section id of all fields to be duplicated
                
                // document fragment idea starter? 
                frag = new DocumentFragment();
                frag.appendChild(volSec.cloneNode());
                
                // if first selection
                if (lastGrpNum == 0) {
                    let changeNum = num;                                            // diff btw prev value and new value
                    lastGrpNum = num;                                               //set new value

                    for(let i = 0; i < changeNum; i++) {
                        document.getElementById('container').after(frag);
                    }
                }
                else {
                    let changeNum = lastGrpNum - num;                               // diff btw prev value and new value
                    lastGrpNum = num;                                               // set new value
                    let pos = (changeNum > 0);
                    switch(pos) {
                        // if adding fields
                        case true:
                            for(let i = 0; i < changeNum; i++) {
                                container.appendChild(volInfo);
                            }

                        // if removing fields
                        case false:
                            container.removeChild(container.lastChild);
                    }        
                }             
            }


            // delay fn stolen from editusers.js
            function delay2(callback, ms) {
                var timer = 0;
                return function() {
                  var context = this, args = arguments;
                  clearTimeout(timer);
                  timer = setTimeout(function () {
                    callback.apply(context, args);
                  }, ms || 0);
                };
            }




            
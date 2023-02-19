
            // --------group registration logic------------------------

            var called = false;
            
            // enables/disables group number input field when checkbox is clicked
            document.getElementById('isgroup').addEventListener('click', function() {
                document.getElementById('group_size').disabled = document.getElementById('isgroup').checked ? false : true; // enable or disable group size field

                let size = document.getElementById('group_size').value;                
                for(let i = 0; i < size - 1; i++) {
                    let extraid = 'e'.concat(i+1);
                    document.getElementById(extraid).hidden = document.getElementById('isgroup').checked ? false : true;    // hide all fields when button is clicked again
                    document.getElementsByClassName(extraid).required = document.getElementById('isgroup');                 // .checked ? true : false;    
                }
            });

            // displays extra fields
            document.getElementById('group_size').addEventListener('click', function() {
                let num = document.getElementById('group_size').value;
                for(let i = 0; i < 9; i++) {
                    let extraid = 'e'.concat(i+1);
                    document.getElementById(extraid).hidden = (i < num - 1) ? false : true; // change back to f : t
                }
            }, true);            
            
            function modifyFields() {
                var num = parseInt(document.getElementById('group_size').value);    // number of volunteers in grp
                var container = document.getElementById('container');               // place where elements should insert
                
                // if first selection
                if (lastGrpNum = 0) {
                    let changeNum = num;                                            // diff btw prev value and new value
                    lastGrpNum = num;                                               //set new value
                    addVolInfo(changeNum);                                          // add vol info # of times = num in grp
                }
                else {
                    let changeNum = lastGrpNum - num;                               // diff btw prev value and new value
                    lastGrpNum = num;                                               // set new value
                    let pos = (changeNum > 0);                                     // check if adding or removing fields

                    if(pos) {
                        addVolInfo(changeNum);
                    }
                    else {

                    }
                    switch(pos) {
                        // if adding fields, add # necessary
                        case true:
                            addVolInfo(changeNum);
                            break;

                        // if removing fields, # remove all and then add amount necessary
                        case false:
                            for(let i = 0; i < changeNum; i++) {
                                container.remove();
                            }
                            break;                          
                    }        
                }             
            }
            
            // add fields
            function addVolInfo(number) {
                var volSection = document.querySelector('volinfo');
                var insert = document.querySelector('container');

                for(let i = 0; i < number; i++) {
                   let clone = volSection.cloneNode(true);
                   clone.id = 'volinfo'.concat(i+1);
                   
                   insert.after(clone);
                }
            }



            
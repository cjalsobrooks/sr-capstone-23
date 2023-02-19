
            // --------group registration logic------------------------

            // enables/disables group number input field when checkbox is clicked
            document.getElementById('isgroup').addEventListener('click', function() {
                document.getElementById('group_size').disabled = document.getElementById('isgroup').checked ? false : true; // enable or disable group size field

                let size = document.getElementById('group_size').value;                
                for(let i = 0; i < size - 1; i++) {
                    let extraid = 'e'.concat(i+1);
                    document.getElementById(extraid).hidden = document.getElementById('isgroup').checked ? false : true;    // hide all fields when button is clicked again
                    document.getElementsByClassName(extraid).required = document.getElementById('isgroup').checked ? true : false;    
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
 $(document).ready(function () {
                    $("#txt_fn").keypress(function (event) {
                        var inputValue = event.which;
                        //Allow letters, white space, backspace and tab. 
                        //Backspace ASCII = 8 
                        //Tab ASCII = 9 
                        if (!(inputValue >= 65 && inputValue <= 123)
                            && (inputValue != 32 && inputValue != 0)
                            && (inputValue != 48 && inputValue != 8)
                            && (inputValue != 9)){
                                event.preventDefault(); 
                        }
                        
                    });
                    $('#txt_fn').keypress(function()
                    {
                        $('#smallfn').hide();
                    });
                    $('#txt_ln').keypress(function()
                    {
                        $('#smallln').hide();
                    });
                    $('#inlineRadio1').click(function(){
                        $('#smallgender').hide();
                    });
                    $('#inlineRadio2').click(function(){
                        $('#smallgender').hide();
                    });
                    $('#txt_email').keypress(function()
                    {
                        $('#smallemail').hide();
                    });
                    $('#txt_username').keypress(function()
                    {
                        $('#smalluser').hide();
                    });
                    $('#txt_password').keypress(function()
                    {
                        $('#smallpass').hide();
                    });
                    $('#txt_confirmpass').keypress(function()
                    {
                        $('#smallconfirm').hide();
                    });
                });

 
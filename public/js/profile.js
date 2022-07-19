let tabcount=0;
jQuery(document).ready(function($){
    $("#prevBtn").click(function(e) {
        e.preventDefault();
        tabcount--;
    })
    $("#nextBtn").click(function(e) {
        e.preventDefault();

        // $(document).on('change', '#file', function(){
        // var tab = document.getElementsByClassName("tab");
        // var txt = elem.textContent || elem.innerText;
        savedata(tabcount++)

    })
    $("#cover-picture").change(function(e) {
        e.preventDefault();

        let dp = document.getElementById("cover-picture").files[0].name;
        let ext = dp.split('.').pop().toLowerCase();
        // console.log('extenion', ext)
        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            Toastify({
                text: "Please Upload valid Image file",
                duration: 3000,
                gravity: "bottom", // `top` or `bottom`
                position: 'right', // `left`, `center` or `right`
                backgroundColor: "#D93637",
                stopOnFocus: true,
                onClick: function () {
                }
            }).showToast();
        }else{
            readCoverURL(this);

        }
    })

    function readCoverURL(input) {
        // console.log("Input",input)
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#cover-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
            let form_image = new FormData();
            form_image.append("cover_avatar", document.getElementById('cover-picture').files[0])


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/home/changecover',
                type:"POST",
                data:form_image,
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log('Response', data)

                    Toastify({
                        text: data.response,
                        duration: 3000,
                        gravity: "bottom", // `top` or `bottom`
                        position: 'right', // `left`, `center` or `right`
                        backgroundColor: "#D93637",
                        stopOnFocus: true,
                        onClick: function(){}
                    }).showToast();
                }
            });
        }
    }

        $("#dp-picture").change(function(e) {
        e.preventDefault();

        let dp = document.getElementById("dp-picture").files[0].name;
            let ext = dp.split('.').pop().toLowerCase();
            console.log('extenion', ext)
            if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                Toastify({
                    text: "Please Upload valid Image file",
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function () {
                    }
                }).showToast();
        }else{
                readURL(this);

            }

        // console.log("picture chaged")
    });
    function readURL(input) {
        // console.log("Input",input)
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#dp-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
            let form_image = new FormData();
            form_image.append("avatar", document.getElementById('dp-picture').files[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/home/changedp',
                type:"POST",
                data:form_image,
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log('Response', data)

                    Toastify({
                        text: data.response,
                        duration: 3000,
                        gravity: "bottom", // `top` or `bottom`
                        position: 'right', // `left`, `center` or `right`
                        backgroundColor: "#D93637",
                        stopOnFocus: true,
                        onClick: function(){}
                    }).showToast();
                }
            });
        }
    }
})

function  savedata(tab) {
    console.log("The tab index is:",tab)
    // let button=document.getElementById("nextBtn").textContent;
    // console.log("button text",button)
    if(tab==0) {
        var cover = document.getElementById("wizard-cover").files[0].name;
        var dp = document.getElementById("wizard-picture").files[0].name;
        if (cover !== undefined && dp !== undefined) {
            // console.log("Image and cover upload",cover+dp)
            var ext = cover.split('.').pop().toLowerCase();
            var ext_dp = dp.split('.').pop().toLowerCase();
            console.log('extenion', ext)
            if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                Toastify({
                    text: "Please Upload valid Image file",
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function () {
                    }
                }).showToast();
                window.setTimeout(function () {
                    window.location.reload();
                }, 1000);
            } else if (jQuery.inArray(ext_dp, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                Toastify({
                    text: "Please Upload valid Image file",
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function () {
                    }
                }).showToast();
                window.setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        }
    }
    if (tab ==3) {
        console.log("yeah its successful")
        var form_data = new FormData();
        // let stuff=$("").val();
        let stuff = document.querySelector("#stuff").textContent;
        console.log("The stuff is:",stuff);
        var status=$( "input[type=radio][name=gender]:checked" ).val();
        console.log(status)
        let profession=$('#profession').val();
        let jobtitle=$('#jobtitle').val();
        let companyname=$('#companyname').val();
        let starttime=$('#starttime').val();
        let endtime=$('#endtime').val();
        console.log(profession+jobtitle+companyname+starttime+endtime)
        let education=$('#education').val();
        let universityname=$('#universityname').val();
        let startdate=$('#startdate').val();
        let enddate=$('#enddate').val();
        console.log("education",education)
        var cover = document.getElementById("wizard-cover").files[0].name;
        var dp = document.getElementById("wizard-picture").files[0].name;
        if (cover !== undefined && dp !== undefined) {
            // console.log("Image and cover upload",cover+dp)
            var ext = cover.split('.').pop().toLowerCase();
            var ext_dp = dp.split('.').pop().toLowerCase();
            console.log('extenion',ext)
            if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                Toastify({
                    text: "Invalid Image File",
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function () {
                    }
                }).showToast();
            } else if (jQuery.inArray(ext_dp, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                Toastify({
                    text: "Invalid Image File",
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function () {
                    }
                }).showToast();
            }
            form_data.append("avatar", document.getElementById('wizard-picture').files[0]);
            form_data.append("avatar_cover", document.getElementById('wizard-cover').files[0]);
            form_data.append("interested_in",stuff);
            form_data.append("martial_status",status);
            form_data.append("profession",profession);
            form_data.append("company_name",companyname);
            form_data.append("profession_title",jobtitle);
            form_data.append("profession_start_date",starttime);
            form_data.append("profession_end_date",endtime);
            form_data.append("education",education);
            form_data.append("university_name",universityname);
            form_data.append("education_start_date",startdate);
            form_data.append("education_end_date",enddate);
// console.log('form data',form_data)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/home/postavatar',
                type:"POST",
                data:form_data,
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log('Response', data)
                    $('.modal').modal('hide');
                    // document.getElementById("createForm").reset();
                    // document.getElementById("filer_input").reset();
                    // document.getElementById("video").reset();
                    // $('#filer_input').val('')
                    // $('#video').val('')

                    // $('#filer_input').wrap('<form>').closest('form').get(0).reset();
                    // $('#filer_input').unwrap();
                    // Toastify({
                    //     text: data.response,
                    //     duration: 3000,
                    //     gravity: "bottom", // `top` or `bottom`
                    //     position: 'right', // `left`, `center` or `right`
                    //     backgroundColor: "#D93637",
                    //     stopOnFocus: true,
                    //     onClick: function(){}
                    // }).showToast();
                }
            });

        }
    }
}

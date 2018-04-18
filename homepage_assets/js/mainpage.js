$(document).ready(function() {

    var genre = ["pop", "hip-hop", "electronic","country","rock","randb","latino"];
    var show_list1 = [];
    var show_list2 = [];
    var container_list = [];
    var maincontent_list = [];


    genre.forEach(
        function (i) {
            show_list1.push("#show"+i);
            show_list2.push("#show_"+i);
            container_list.push("."+i+"_container");
            maincontent_list.push("#mainContent_" + i);
        });


    for (let i=0; i<genre.length;i++) {
        $(show_list1[i]).click(function () {
            $(maincontent_list[i]).show();
            for (let j = 0; j < genre.length; j++) {
                if (j !== i) {
                    $(maincontent_list[j]).hide();

                }
            }
        });

    }

    for (let i=0; i<genre.length;i++) {
        $(show_list2[i]).click(function () {
            $(container_list[i]).show();
            for (let j = 0; j < genre.length; j++) {
                if (j !== i) {
                    $(container_list[j]).hide();

                }
            }
        });
    }
});



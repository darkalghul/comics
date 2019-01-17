var current_path = window.location.href;

var id_array = current_path.split("/");

var comid_id = id_array[id_array.length - 1];

// $.ajax({
//     data: 'current_id': comid_id,
//     url: '../../comic.php',
//     method: 'POST'
// })

// var ajax = new XMLHttpRequest();
// ajax.onreadystatechange = function() {
// 	if (ajax.readyState == 4 && ajax.status == 200) {
// 		var response = ajax.responseText;
// 	}
// };
// ajax.open(method, URL, true);
// ajax.setRequestHeader("Content-type", "application/json");
// ajax.send(data);
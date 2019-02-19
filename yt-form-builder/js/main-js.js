
var i = 1;
var d = 99;
var uniq =  0;


function addtextbox() {

        i++;
        d++;

        createTextbox.innerHTML = createTextbox.innerHTML +"<span  id='"+d+"'><input class='input-f' placeholder='Write Name' onkeyup='add("+i+")' type='text' id='"+i+"' name='title' ></span>";
        options.innerHTML = options.innerHTML +"<span  id='"+d+"'><button class='del' onclick='del("+d+")'>Remove</button></span>";

}

function addsubmit() {

        uniq++;
        i++;
        d++;

         if(uniq > 1){
             document.getElementById("in-message").innerHTML = "Submit is selected!";
             return false;
         }

        createTextbox.innerHTML = createTextbox.innerHTML +"<span  id='"+d+"'><input class='input-f-submit' type='button' id='sub' name='mytext' ></span>";
        options.innerHTML = options.innerHTML +"<span  id='"+d+"'><input class='input-f-sub' onkeyup='add_submit_val("+i+")' placeholder='buttom title' type='text' id='"+i+"' name='mytext' ></span>";
        options.innerHTML = options.innerHTML +"<span  id='"+d+"'><button class='del' onclick='del("+d+")'>Remove</button></span>";

}

function add(i) {

    var x = document.getElementById(i).value;
    x = x.replace(' ', '_');
    x = x.replace('-', '_');
    document.getElementById(i).name = x;
    document.getElementById(i).placeholder = x;

}

function del(d) {
    var item = document.getElementById(d);
    item.remove(item);
    var item2 = document.getElementById(d);
    item2.remove(item2);
    var item3 = document.getElementById(d);
    item3.remove(item3);
    uniq = 0;
    document.getElementById("in-message").innerHTML = "";
}

function add_submit_val(i) {

    var v = document.getElementById(i).value;
    v = v.replace(' ', '_');
    v = v.replace('-', '_');
    document.getElementById("sub").value = v;



}


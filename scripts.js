showform(id){
    let title = document.getElementById(id+"t");
    let type = document.getElementById(id+"ty");
    let priority = document.getElementById(id+"p");
    let status = document.getElementById(id+"s");
    let description = document.getElementById(id+"de");
    let date = document.getElementById(id+"d");
    task_id.value = id;
    task_title.value = title.getAttribute("date");
    task_date.value = date.getAttribute("date");
    task_description.value = description.getAttribute("date");

    if(type.getAttribute("data")=="Bug"){
        task_type_bug.checked = true;
    }
    else{
        task_type_feature.checked = true;
    }
    task_priority.value = priority.getAttribute("data");
    show_modal.click();
}
showform(id,title,status,date,description,priority,type){

    task_id.value = id;
    title_task.value = title;
    if(type=='Feature'){
        task_type_Feature.checked=true; 

    }else{
        task_type_Bug.checked=true;
    }
    task_status.value=status;
    task_description.value=description;
    task_date.value =date;
   

    
    show_modal.click();
}
function check_size(max_size)
{
    var input = document.getElementById("upload");
    // check for browser support (may need to be modified)
    if(input.files && input.files.length == 1)
    {           
        if (input.files[0].size > max_size) 
        {
            alert("El tamaño del archivo debe ser inferior a " + (max_size/1024/1024) + "MB");
            return false;
        }
    }

    return true;
}
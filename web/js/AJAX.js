function CreateRequest()
{
    var Request = false;

    if (window.XMLHttpRequest)
    {
        //Gecko-совместимые браузеры, Safari, Konqueror
        Request = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        //Internet explorer
        try
        {
            Request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (CatchException)
        {
            Request = new ActiveXObject("Msxml2.XMLHTTP");
        }
    }

    if (!Request)
    {
        alert("Невозможно создать XMLHttpRequest");
    }

    return Request;
}

function SendRequestGet(r_path, r_args, r_handler)
{
    var Request = CreateRequest();
    if (!Request)return;

    Request.onreadystatechange = function()
    {
        if (Request.readyState === 4) r_handler(Request);
    };

    if (r_args.length > 0) r_path += "?" + r_args;

    Request.open("GET", r_path, true);
    Request.send(null);

}

function SendRequestPost(r_path, r_args, r_handler)
{
    var Request = CreateRequest();
    if (!Request)return;

    Request.onreadystatechange = function()
    {
        if (Request.readyState === 4) r_handler(Request);
    };

    Request.open("POST", r_path, true);
    Request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
    Request.send(r_args);

}
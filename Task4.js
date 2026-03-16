const COST = 1000;
const apples = document.getElementById('apples');
const price = document.getElementById('price');
apples.oninput=function()
{
    let num=Number(apples.value);
    if ( num<0)
    {
        num=0;
        apples.value=0;
    }
    let total = COST* num;
    price.textContent=total;
    if(total>1000)
    {
        alert('Free')
    }
};
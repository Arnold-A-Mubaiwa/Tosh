function calculate() {
    var income = parseInt(document.getElementById('Income').value);
var expensies = parseInt(document.getElementById('Expensies').value);
var debt =parseInt(document.getElementById('TotalDebt').value);
var months_to_pay =parseInt(document.getElementById('Months').value);
var net = income - expensies;

var amount;
    var msg = "";
    var x = 1;
    var m_p  = 0;
    var monthlyPayB4Interest = debt/months_to_pay;
    while(x<=months_to_pay){
        m_p +=(monthlyPayB4Interest*(6/100));
        x++;
    }
   
    var  total_payment = debt+m_p;
    console.log(total_payment);
    amount = total_payment/ months_to_pay;
    amount = amount.toFixed(2);
    if (amount>net){
        msg = amount+ " Your debt repayment amount exceeds your net income. Contact Us and have a chat with our financial experts for debt repayment restructuring and advice";
        // console.log("Your debt repayment amount exceeds your net income. Contact Us and have a chat with our financial experts for debt repayment restructuring and advice");
    }
    else if (amount>700) {
        msg="The Lowest amount you can pay on your debt is R"+amount+" per month. Contact Us and have a chat with our financial experts for debt repayment restructuring and advice";
        // console.log("The Lowest amount you can pay on your debt is "+amount+". Contact Us and have a chat with our financial experts for debt repayment restructuring and advice");
    }else{
        msg =amount+" Your accounts seems to be in order. Contact Us and have a chat with our financial experts for debt repayment restructuring and advice";
        // console.log("Your accounts seems to be in order. Contact Us and have a chat with our financial experts for debt repayment restructuring and advice");
    }  
return msg;
}

function displayinfo() {
    document.getElementById('inner').innerText=calculate();
    console.log(calculate());
 }    
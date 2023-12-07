let registerSellerCheckbox = document.getElementById("is_selling");
let sellerQuestions = document.getElementById("sellerQuestions");

/*function registerSeller(){
    if(registerSellerCheckbox.checked == true){
        sellerQuestions.style.display = "block";
    }
    else{
        sellerQuestions.style.display = "none";
    }
   
}
*/

registerSellerCheckbox.addEventListener('click', function handleClick() {
    if (registerSellerCheckbox.checked) {
      sellerQuestions.style.display = 'block';
    } else {
      sellerQuestions.style.display = 'none';
    }
  });
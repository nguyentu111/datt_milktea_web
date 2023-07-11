import lodash from "lodash";
const addRecipesBtn = $("#add-recipes");
const cancleBtn = $("#cancle-add-recipes");
const recipesElement = $("#recipes");
const materialInput = $(".mat-input");
const searchMat = $("#search-mat");
const pictureInput = $("#product-picture");

// materialInput.on("change", function (e) {
//     if (e.target.checked)
//         $(e.target.closest(".mat-item")).children(".mat-amount")?.show();
//     else $(e.target.closest(".mat-item")).children(".mat-amount")?.hide();
// });
// addRecipesBtn.on("click", function () {
//     cancleBtn.show();
//     addRecipesBtn.hide();
//     recipesElement.show();
//     searchMat.show();
// });
// cancleBtn.on("click", function () {
//     cancleBtn.hide();
//     addRecipesBtn.show();
//     recipesElement.hide();
//     searchMat.hide();
// });
// searchMat.on("input", function (e) {
//     const searchTerm = e.target.value;
//     clearTimeout(this.delay);
//     this.delay = setTimeout(
//         function () {
//             $("#recipes > div")
//                 .toArray()
//                 .forEach((item) => {
//                     const checked =
//                         item.children[0].children[0].children[1].checked;
//                     if (!checked) item.style.display = "none";
//                     if (
//                         !searchTerm ||
//                         item.children[1].textContent
//                             .toLowerCase()
//                             .includes(searchTerm.toLowerCase())
//                     )
//                         item.style.display = "block";
//                 });
//         }.bind(this),
//         800
//     );
// });
// $("input.decimal-only").on("keydown", function (event) {
//     if (event.shiftKey == true) {
//         event.preventDefault();
//     }
//     if (
//         (event.keyCode >= 48 && event.keyCode <= 57) ||
//         (event.keyCode >= 96 && event.keyCode <= 105) ||
//         event.keyCode == 8 ||
//         event.keyCode == 9 ||
//         event.keyCode == 37 ||
//         event.keyCode == 39 ||
//         event.keyCode == 46 ||
//         event.keyCode == 190
//     ) {
//     } else {
//         event.preventDefault();
//     }
//     if ($(this).val().indexOf(".") !== -1 && event.keyCode == 190)
//         event.preventDefault();
// });
// const createProductForm = $("#create-product-form");
// createProductForm.on("submit", (e) => {
//     // e.preventDefault();
//     const data = lodash.concat(...createProductForm.serializeArray());
//     let mats = null;
//     console.log(data);
//     if (addRecipesBtn.is(":hidden")) {
//         mats = [];
//         data.forEach((item) => {
//             if (item.name.includes("mat")) {
//                 const id = item.name.substring(4);
//                 if (!isNaN(id)) {
//                     const amount = data.find(
//                         (item) => item.name === "mat-amount-" + id
//                     ).value;
//                     mats.push({
//                         id,
//                         amount: parseFloat(amount),
//                     });
//                 }
//             }
//         });
//     }
//     $.ajax({
//         url: "/dashboard/products/create",
//         method: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,
//         success: function (response) {
//             console.log(response);
//         },
//     });
// });

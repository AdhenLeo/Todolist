const notifications = document.querySelector(".notifications"),
buttons = document.querySelectorAll(".buttons .btn")

console.log(notifications)

const toastDetails = {
timer: 5000,
success: {
  icon: "fa-circle-check",
  text: "Hello World: This is a success toast.",
},
error: {
  icon: "fa-circle-xmark",
  text: "Hello World: This is an error toast.",
},
warning: {
  icon: "fa-triangle-exclamation",
  text: "Hello World: This is a warning toast.",
},
info: {
  icon: "fa-circle-info",
  text: "Hello World: This is an information toast.",
},
random: {
  icon: "fa-solid fa-star",
  text: "Hello World: This is a random toast.",
},
}

const removeToast = (toast) => {
toast.classList.add("hide")
if (toast.timeoutId) clearTimeout(toast.timeoutId)
setTimeout(() => toast.remove(), 500)
}

const createToast = (msg ,id) => {
const { icon, text } = toastDetails[id]
const toast = document.createElement("li")
toast.className = `toast ${id}`
toast.style.backgroundColor = "#191c24"
toast.style.color = "white"
toast.innerHTML = `<div class="column"">
                       <i class="fa-solid ${icon}"></i>
                       <span>${msg}</span>
                    </div>
                    <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>`
notifications.appendChild(toast) 
toast.timeoutId = setTimeout(() => removeToast(toast), toastDetails.timer)
}

const btn = document.getElementById("success")
btn.addEventListener("click", ()  => {
  createToast(btn.id)
  console.log("click")
})
buttons.forEach((btn) => {
btn.addEventListener("click", () => {
  console.log("ok")
})
})
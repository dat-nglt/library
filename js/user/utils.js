function success(msg, link) {
  Swal.fire({
    title: "Thông báo",
    text: msg,
    icon: "success",
    showConfirmButton: true,
  }).then(function () {
    window.location.assign(link);
  });
}

function error(msg, link) {
  Swal.fire({
    title: "Thông báo",
    text: msg,
    icon: "error",
    showConfirmButton: true,
  }).then(function () {
    window.location.assign(link);
  });
}

function warning(msg, link) {
  Swal.fire({
    title: "Thông báo",
    text: msg,
    icon: "warning",
    showConfirmButton: true,
  }).then(function () {
    window.location.assign(link);
  });
}

export { success, error, warning };

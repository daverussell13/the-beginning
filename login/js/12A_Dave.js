$(document).ready(function () {

    const linkup = $(".up"),
        linklog = $(".log"),
        logcontainer = $(".login"),
        signcontainer = $(".sign-up");

    $(linkup).click(function() {
        $(logcontainer).removeClass("hidden");
        $(signcontainer).addClass("hidden");
    });

    $(linklog).click(function() {
        $(signcontainer).removeClass("hidden");
        $(logcontainer).addClass("hidden");
    });
});

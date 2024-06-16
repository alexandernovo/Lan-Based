function seePassword(id) {
    console.log("see");
    let $input = $(`#${id}`);
    if ($input.attr("type") === "password") {
        $input.attr("type", "text");
    } else {
        $input.attr("type", "password");
    }
}
$(".btn-like").each(function(idx, el) {
    var button = $(el)
    var heartShape = button.find(".heart-shape")
    $.get("/practice/like_proc.php", {
        getLikedByCode: button.data("articleId")
    }, function(res) {
        heartShape.text(res == "liked" ? "♥" : "♡")
        button.fadeIn(200)
    })
})
$(".btn-like").on("click", function(e) {
    var button = $(e.currentTarget || e.target)
    var likeCount = button.find(".like-count")
    var heartShape = button.find(".heart-shape")
    $.post("/practice/like_proc.php", {
        articleId: button.data("articleId")
    }, function(res) {
        var addCount = (res == "like" ? 1 : res == "unlike" ? -1 : 0)
        likeCount.text(+likeCount.text() + addCount)
        heartShape.text(res == "like" ? "♥" : res == "unlike" ? "♡" : "♡")
    })
    
})
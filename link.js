var regex_arobase = /(?:^\@.*)/gi
var regex_hashtag = /(?:^\#.*)/gi
const tweet_content = document.getElementById("test")

function go_profil(e){
    console.log(e.textContent);
}

$("#send").click(function (e) {
    var xhr = new XMLHttpRequest()
    var data = new FormData()

    data.append("test", search.value.substr(0, 140))
    xhr.open("POST", "tweet.php")
    xhr.send(data)

    xhr.onreadystatechange = function () {
            
        if (this.readyState == 4 && this.status == 200) {
            var res = this.response

            console.log(res)
        
            tweet_content.innerHTML = res["msg"].replace(/\r?\n|\r/g, "<br>")

        } else if (this.response == 4) {
            alert("une erreur est survenue !")
        } else if (this.response == 500) {
            alert("connexion a la base de donnée impossible")
        }
    }

    xhr.responseType = "json"
    
    e.preventDefault()
    return true
})

function tweet () {
    var content = tweet_content.innerHTML
    console.log(content);
    var remove = content.replace(/<br>/gm, ' ')
    var array_str = remove.split(' ')
    array_str.forEach(element => {
        if (element.match(regex_arobase)) {
            re = new RegExp(element.match(regex_arobase), 'gi')
            var string = '<span id="username" onclick="go_profil(this)">' + element + '</span>'
            console.log(element)
            final = content.replace(re, string)
            content = final
        }
        if (element.match(regex_hashtag)) {
            reg = new RegExp(element.match(regex_hashtag), 'gi')
            var string = '<span id="hashtag" onclick="go_profil(this)">' + element + '</span>'
            final = content.replace(reg, string)
            content = final
        }
    });
    tweet_content.innerHTML = content
}

$("#tweet").click(function () {
    tweet()
})
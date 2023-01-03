const spawn = require('child_process').spawn
app.get("process_data", (req, res) => {
    spawn('python3', ['mytest0.py'])
})
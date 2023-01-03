const exec = require('child_process').exec


const p0 = new Promise((resolve, reject)=>{
    let v0 = "i am js"
    resolve(v0)
})
p0.then((value)=>{
    console.log(value)
}).then(()=>{
    let v1 = 'success'
    let v2 = 'test'

    let cmdStr = 'python mytest0.py'  
    exec(cmdStr, (err, stdout, stderr)=>{
        if(err){
            console.log(stderr)
        }else{
            console.log(stdout)
        }
    })
    return v1
}).then((v1)=>{
    setTimeout(()=>{
        console.log(v1)
    }, 5000)
}).catch((err)=>{
    console.log(err)
}).finally(()=>{
    
})


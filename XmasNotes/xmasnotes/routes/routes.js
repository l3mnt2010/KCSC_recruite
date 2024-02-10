const { isAdmin, authenSecret, randomKey } = require("../utils/authorisation");
const express                 = require("express");
const session = require('express-session');
const uuid = require('uuid');
const router                  = express.Router({caseSensitive: true});
const visit                   = require("../utils/bot.js");

let db;
router.use(session({
    genid: (req) => {
      return uuid.v4();
    },
    secret: randomKey,
    resave: false,
    saveUninitialized: true,
}));

const response = data => ({ message: data });

router.get("/", (req, res) => {
    return res.render("index.html");
});

router.get("/notes", (req, res) => {
    return res.render("viewnotes.html");
});

router.post("/submit", async (req, res) => {
    const { message } = req.body;
    if (message) {
        return db.insertNote(message, uuid.v4())
            .then(async inserted => {
                res.status(201).send(response(inserted));
            })
            .catch(() => {
                res.status(500).send(response('Something went wrong!'));
            });
    }
    return res.status(401).send(response('Missing required parameters!'));
});

router.get("/note/:uuid", async (req, res) => {
    try {
        const { uuid } = req.params;
        const message = await db.getNote(uuid);

        if (!message) return res.status(404).send({
            error: "Can't find this note!",
        });

        if (message.hidden && !isAdmin(req))
            return res.status(401).send({
                error: "Sorry, this note has been hidden by admin!",
            });

        return res.status(200).send({
            message: message.message,
        });
    } catch (error) {
        console.error(error);
        res.status(500).send({
            error: "Something went wrong!",
        });
    }
});

router.get("/visit/:uuid", async (req, res) => {
    const { uuid } = req.params;
    if (uuid) {
        try {
            await visit(`http://127.0.0.1:1337/notes?uuid=${uuid}`, authenSecret);
            res.status(200).json({ message: 'Bot has been visited' });
        } catch (e) {
            console.log(e);
        }
    } else {
        res.status(400).json({ error: 'Invalid uuid' });
    }
});

module.exports = (database) => {
    db = database;
    return router;
};
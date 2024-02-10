const sqlite = require("sqlite-async");

class Database {
    constructor(db_file) {
        this.db_file = db_file;
        this.db = undefined;
    }

    async connect() {
        this.db = await sqlite.open(this.db_file);
    }

    async migrate() {
        return this.db.exec(`
            DROP TABLE IF EXISTS notes;

            CREATE TABLE IF NOT EXISTS notes (
                uuid      VARCHAR(300) NOT NULL,
                message   VARCHAR(300) NOT NULL,
                hidden    INTEGER NOT NULL
            );

            INSERT INTO notes (uuid, message, hidden) VALUES
                ("1", "Merry christmas ! KCSC{fakeflag}.", 1)
            `);
    }

    async getNote(uuid) {
        return new Promise(async(resolve, reject) => {
            try {
                let stmt = await this.db.prepare("SELECT * FROM notes WHERE uuid = ?");
                resolve(await stmt.get(uuid));
            } catch (e) {
                reject(e);
            }
        });
    }

    async insertNote(message, uuid) {
        return new Promise(async(resolve, reject) => {
            try {
                let stmt = await this.db.prepare("INSERT INTO notes (uuid, message, hidden) VALUES (?, ?, ?)");
                await stmt.run(uuid, message, false);
                resolve(uuid);
            } catch (e) {
                reject(e);
            }
        });
    }
}

module.exports = Database;
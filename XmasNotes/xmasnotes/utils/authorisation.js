const authenSecret = require('crypto').randomBytes(52).toString('hex');
const randomKey = require('crypto').randomBytes(52).toString('hex');

const isAdmin = (req, res) => {
  return req.ip === '127.0.0.1' && req.cookies['auth'] === authenSecret;
};

module.exports = {
  authenSecret,
  randomKey,
  isAdmin,
};

# Using flask to make an api
# import necessary libraries and functions
from flask import Flask, jsonify

# creating a Flask app
app = Flask(__name__)

#http://127.0.0.1:5000/Indian
@app.route("/Indian", methods=['GET'])
def getIndianFoods():
    indianFood=["Chhole Bhature","Bharwa Bhindi","Okra","Pindi Chana","Masala Chai","Samosa","Kulche","Panipuri/Golgappe/Phuchka","Appam","Jalebi"];
    return jsonify(indianFood);


#http://127.0.0.1:5000/Chinese
@app.route("/Chinese", methods=['GET'])
def getChineseFoods():
    chineseFood=["Fried Rice (Chǎofàn)", "Peking Duck (Běijīng Kǎoyā)", "Stinky Tofu (Chòudòufu)", "Chow Mein", "Congee (Báizhōu)", "Chinese Hamburger (Ròu Jiā Mó)", "Scallion Pancakes (Cong You Bing)", "Kung Pao Chicken (Gong Bao Ji Ding)","MAPO TOFU (MÁPÓ DÒUFU)","ZHAJIANGMIAN"];
    return jsonify(chineseFood);

#http://127.0.0.1:5000/Italian
@app.route("/Italian", methods=['GET'])
def getItalianFoods():
    italianFood=["Risotto Alla Milanese", "Lasagna", "Ravioli", "Osso buco", "Arancini", "Ribollita", "Neapolitan pizza","Caprese sala","Spaghetti Alla Carbonara","Gnocchi"];
    return jsonify(italianFood);


# driver function
if __name__ == '__main__':
    app.run(debug=True)
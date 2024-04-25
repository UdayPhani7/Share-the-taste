CREATE DATABASE my_db;

USE my_db;

CREATE TABLE `users` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `recipe` (
  `rid` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `rname` varchar(255) DEFAULT NULL,
  `rtype` varchar(10) DEFAULT NULL,
  `preptime` int DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `video_url` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `connect` (
  `cid` bigint(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `uid` bigint(10) NOT NULL,
  `rid` bigint(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `users`
ADD FOREIGN KEY (uid) REFERENCES `connect`(uid);

ALTER TABLE `recipe`
ADD FOREIGN KEY (rid) REFERENCES `connect`(rid);

INSERT INTO `users`(name, email, password, bio) VALUES ("Admin", "pphanindra.19.cse@anits.edu.in", "9a1996efc97181f0aee18321aa3b3b12", "I am Admin of Share The Taste");

INSERT INTO `recipe`(rname, rtype, preptime, ingredients, description, image_url, video_url) VALUES ("Lamb Chops","Non-Veg",150,"1 pound lamb rib chops,2 tablespoons minced fresh rosemary,2 teaspoons salt,1 teaspoon freshly ground black pepper,1 garlic clove, minced,4 tablespoons extra virgin olive oil, divided.","Food is any substance consumed to provide nutritional support for an organism. Food is usually of plant, animal, or fungal origin, and contains essential nutrients, such as carbohydrates, fats, proteins, vitamins, or minerals. The substance is ingested by an organism and assimilated by the organism's cells to provide energy, maintain life, or stimulate growth. Different species of animals have different feeding behaviours that satisfy the needs of their unique metabolisms, often evolved to fill a specific ecological niche within specific geographical contexts.","lamb.jpg","sample_640x360.mp4");

INSERT INTO `connect`(uid, rid) VALUES(1,1);

INSERT INTO `recipe`(rname, rtype, preptime, ingredients, description, image_url, video_url) VALUES ("Gobi Paratha","Veg",50,"1½ cups + 1/2 cup Whole Wheat Flour
2 cups grated Cauliflower (gobi)
1 small Potato, boiled, peeled, grated, optional
1/4 teaspoon Cumin Seeds
1 medium Onion, finely chopped
1 teaspoon Ginger-Garlic Paste
1 Green Chilli, finely chopped
2 tablespoons finely chopped Coriander Leaves
1 teaspoon Lemon Juice or Dry Mango Powder (Amchur Powder)
1/3 teaspoon Garam Masala Powder
1/8 teaspoon Turmeric Powder
1/4 teaspoon Red Chilli Powder
5 teaspoons Oil + for shallow frying
2 tablespoons Butter, for serving
Salt to taste","Knead a very smooth dough to roll out stuffed paratha easily. To make extra smooth parathas, knead the dough using milk instead of water.
Increase the quantity of green chilli for a hot spicy taste.
When you spread butter, slightly pinch paratha at multiple places using spoon so that some melted butter goes inside it. This will give it a heavenly texture.","Gobi-Cauliflower-Paratha-Recipe.jpg","sample_640x360.mp4");

INSERT INTO `connect`(uid, rid) VALUES(1,2);

INSERT INTO `recipe`(rname, rtype, preptime, ingredients, description, image_url, video_url) VALUES ("Masala Dosa","Veg",20,"3 cups Dosa Batter
4 to 5 medium Potatoes, boiled (approx. 2 cups when chopped)
1 large Onion, thinly sliced (approx. 1/2 cup)
1/2 teaspoon Mustard Seeds
1/2 teaspoon Cumin Seeds
1 teaspoon Chana Dal (Bengal gram), soaked in hot water for 30 minutes
1/2 teaspoon Urad Dal (split black lentils), optional
A pinch of Asafoetida (hing)
8-10 Curry leaves
1 Green Chilli, finely chopped (or to taste)
2 tablespoons broken Cashew Nuts, optional
A pinch of Turmeric Powder
2 tablespoons Oil
1/3 cup Water, optional
Salt to taste
2-3 tablespoons finely chopped Coriander Leaves
2-3 tablespoons Butter or Oil, for greasing while making dosa","For ease of preparation, use either ready-made (store-bought) dosa batter or make dosa batter in advance. You can prepare batter one day prior to cooking and keep it in the refrigerator.
To get crispy texture for dosa, make sure that tawa is heated properly. If tawa is over-heated, it will be difficult to spread the batter evenly.
To spread batter evenly and prevent dosa from sticking to tawa, sprinkle few drops of water over heated tawa and let it evaporate, spread oil over it and wipe it with a wet cloth before making each dosa.","dosa.jpg","sample_640x360.mp4");

INSERT INTO `connect`(uid, rid) VALUES(1,3);

INSERT INTO `recipe`(rname, rtype, preptime, ingredients, description, image_url, video_url) VALUES ("Pav Bhaji","Veg",20,"2 medium Potatoes (approx. 1½ cups chopped)
1/2 cup Green Peas (fresh or frozen)
3/4 cup chopped Cauliflower (approx. 1/4 head of cauliflower)
1/2 cup chopped Carrot (approx. 1 medium)
1 large Onion, chopped (approx. 3/4 cup)
1 tablespoon Ginger Garlic Paste
2 medium Tomatoes, chopped (approx. 1¼ cup)
1/2 cup chopped Capsicum (approx. 1 small)
1½ teaspoons Red Chilli Powder (or less)
1/4 teaspoon Turmeric Powder
1 teaspoon Cumin-Coriander Powder, optional
1 teaspoon Readymade Pav Bhaji Masala Powder
1 teaspoon Lemon Juice
Salt to taste
2 tablespoons Oil + 2 tablespoons Butter
Butter for serving
2 tablespoons finely chopped Coriander Leaves
8 Pav Buns, for serving","Mash boiled veggies until it has the texture that you prefer (in step-4) your bhaji to have – little chunky or smooth paste.
Add a small piece of beetroot along with vegetables while boiling to get the deep red color of bhaji. Additionally use Kashmiri red chilli powder instead of regular red chilli powder.
Garnish hot bhaji with grated mozzarella cheese to make cheese pav bhaji.
The taste of bhaji greatly depends on the butter, so don’t reduce its quantity.
In this recipe we have used Badshah brand readymade pav bhaji masala but you can use any other brand’s masala.","YFL-Pav-Bhaji-3.jpg","sample_640x360.mp4");

INSERT INTO `connect`(uid, rid) VALUES(1,4);

INSERT INTO `recipe`(rname, rtype, preptime, ingredients, description, image_url, video_url) VALUES ("Mushroom Masala","Veg",40," White Button Mushroom
1/2 cup Capsicum, sliced (approx. 1/2 cup)
1 teaspoon Dry Coriander Seeds
1 Dry Red Kashmiri Chili, seeds removed and broken into 2-3 pieces
1 Green Cardamom
1/2 inch piece of Cinnamon
1 large Onion, chopped
2 medium Tomatoes, chopped (approx. 3/4 cup)
1 teaspoon Ginger-Garlic Paste
1/2 teaspoon Red Chili Powder
A pinch of Turmeric Powder, optional
1/2 teaspoon Kasuri Methi, optional
1/4 cup Milk, optional
1/2 cup Water
Salt to taste
1½ tablespoon Oil
1 tablespoon Butter (or oil)","Add red capsicum along with green capsicum for colorful curry.
Increase or decrease the amount of dry red chilli to make it more or less spicy respectively.
If you want to make curry less spicy but still want its deep red color, use Kashmiri dry red chillies.","mushroom masala recipe.JPG","sample_640x360.mp4");

INSERT INTO `connect`(uid, rid) VALUES(1,5);

INSERT INTO `recipe`(rname, rtype, preptime, ingredients, description, image_url, video_url) VALUES ("Grilled Fish","Non-Veg",60,"1/4 cup vegetable oil, plus more for oiling the grill cage
3 teaspoons kosher salt, divided
1 (2 pound) whole tilapia, cleaned, scaled, and cut open along the belly or butterflied
2 scallions, root ends removed, cut in half lengthwise and widthwise
1 large handful cilantro (about 1 packed cup), leaves and stems
2 red Fresno chilies, thinly sliced crosswise
","Nutrition Facts
Servings: 4
Amount per serving
Calories  359
% Daily Value*
Total Fat 13g 16%
Saturated Fat 3g  13%
Cholesterol 129mg 43%
Sodium 1075mg 47%
Total Carbohydrate 2g 1%
Dietary Fiber 1g  3%
Total Sugars 1g
Protein 60g
Vitamin C 30mg  149%
Calcium 48mg  4%
Iron 2mg  11%
Potassium 957mg 20%","grilled-fish.jpg","sample_640x360.mp4");

INSERT INTO `connect`(uid, rid) VALUES(1,6);

INSERT INTO `recipe`(rname, rtype, preptime, ingredients, description, image_url, video_url) VALUES ("Lobster Rolls","Non-Veg",60,"For the filling:

1 pound cooked lobster meat, cut into 1-inch pieces
3 tablespoons lemon juice
1/4 teaspoon salt
1/8 teaspoon black pepper
1/2 cup finely chopped celery
1/3 cup mayonnaise
For the buns:

4 to 6 New England style split-top hot dog buns
2 to 3 tablespoons soft butter
For serving:

Lemon wedges
Potato chips","NUTRITION FACTS(PER SERVING)
CALORIES-446
FAT-19g
CARBS-44g
PROTEIN-28g","lobsterdijonsandwich.jpg","sample_640x360.mp4");

INSERT INTO `connect`(uid, rid) VALUES(1,7);
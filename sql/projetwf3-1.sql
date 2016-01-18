-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 18 Janvier 2016 à 12:11
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetwf3-1`
--
CREATE DATABASE IF NOT EXISTS `projetwf3-1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projetwf3-1`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'brouillon'),
(2, 'en attente'),
(3, 'Refusé'),
(4, 'Publié'),
(5, 'Article à la une');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `new` enum('no','yes') NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des contacts';

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `email`, `lastname`, `firstname`, `subject`, `message`, `new`, `date`) VALUES
(1, 'michael@mann.com', '', '', '', 'C''est un scandale ce site de merde !!!', 'no', '0000-00-00 00:00:00'),
(2, 'steeven@seagal.com', '', '', '', 'Il manque un slide sur ce putain de site !!!', 'no', '0000-00-00 00:00:00'),
(3, 'alfred@hitchcock.com', '', '', '', 'Shame on you !!!', 'no', '0000-00-00 00:00:00'),
(4, 'miaou@miaou.fr', '', '', 'mi', 'aou', 'no', '2016-01-15 12:26:47'),
(5, 'miaou@miaou.fr', '', '', 'mi', 'aou', 'yes', '2016-01-15 12:27:49'),
(6, 'miaou@miaou.fr', '', '', 'mi', 'aou', 'yes', '2016-01-15 12:29:21'),
(7, 'miaou@miaou.fr', '', '', 'mi', 'aou', 'yes', '2016-01-15 12:30:09'),
(8, 'miaou@miaou.fr', '', '', 'mi', 'aou', 'no', '2016-01-15 12:37:13'),
(9, 'cat@cat.fr', '', '', 'et bé !', 'miaou à bé', 'yes', '2016-01-15 12:40:58'),
(10, 'cat@cat.fr', 'Fhjhl', 'Ekml', 'dfhdssgtn', 'sgnjsgtnjsnjsgnj', 'yes', '2016-01-18 11:54:57'),
(11, 'cat@cat.fr', 'STEbvehg', 'Rnhjhlk', 'dfnhgtnjs,jsyjsyjsytjtsrj', 'stgjtstrjsrt th trh rth', 'no', '2016-01-18 11:55:32');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `publication_date` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `img`, `publication_date`, `id_user`, `category`) VALUES
(1, 'Blackhat, film majeur', 'Michael Mann catapulte à l’ère de la cybercriminalité son rêve d’un cinéma labile et gazeux. Eblouissant.\r\nDepuis l’annonce du projet, le mystérieux titre du dernier film de Michael Mann (Blackhat, traduit pour l’exploitation française en un plus familier Hacker) suscitait de vives attentes et de nombreuses interrogations. Après avoir pris en charge au cours  des années 2000 la mutation numérique du cinéma américain à la faveur de quelques chefs-d’œuvre de l’âge des caméras  haute définition (Collatéral, Miami Vice, Public Enemies), quel allait être le nouveau tour de force du cinéaste ? Comment allait-il appréhender le sujet du hacking ? Quelle nouvelle forme allait-il inventer pour mettre en scène l’ère d’internet, celle des algorithmes et de la cybercriminalité ?\r\n\r\nL’auteur évacue toutes ces questions dès l’ouverture du film, par une saisissante symphonie virtuelle figurant depuis l’intérieur d’un ordinateur l’opération de piratage qui mène à une catastrophe nucléaire, du premier clic effectué  sur le clavier d’un hacker à l’explosion d’une centrale. Ce long et virtuose plan-séquence, composition entièrement numérisée entre l’abstraction picturale et le schéma scientifique ultra précis, lance le film sur la piste trompeuse d’une aventure formelle sur le motif des réseaux informatiques. Trompeuse, car Michael Mann ne se souciera ensuite que très peu de l’objet “hacking”, et il pourra  en cela décevoir ses fans qui attendaient une nouvelle révolution plastique de la part du dernier auteur à réellement penser  les formes du cinéma d’action américain.\r\n\r\nCe qui intéresse Michael Mann ici, ce n’est pas le hacking comme mécanisme technique, mais plutôt comme l’expression terminale d’un monde déréalisé, un monde sans univers palpable, sans frontière et sans héros, produisant chez le cinéaste un sentiment de mélancolie qui nimbe le film d’un épais voile de fatalité. Une fois passée sa brillante exposition, Hacker revient ainsi aux termes les plus classiques du thriller géopolitique (deux spécialistes s’associent pour lutter contre un cybercriminel qui menace l’économie mondiale), une sorte de variation fantomatique de la série Jason Bourne, dont les enjeux auraient été dévitalisés. Ici, on ne  retrouve plus les voyous mythiques ni ces puissantes figures italo-américaines qui ont peuplé la filmographie de Michael Mann ; les nouveaux héros sont éteints, presque transparents, à l’image de Chris Hemsworth (surnommé littéralement “The Ghostman”), grand blond au visage secret, sinon inexpressif, qui porte en lui tous les stigmates du monde virtuel dont le cinéaste fait le portrait.\r\n\r\nA travers ce personnage indéchiffrable, dénué de toute pesanteur psychologique, Michael Mann atteint la formule  la plus radicale de cet idéal de cinéma abstrait qu’il poursuit depuis le milieu des années 2000, brouillant un peu plus  la frontière entre mainstream et art expérimental. Loin de la sécheresse hyperréaliste de Public Enemies, il renoue avec son rêve de blockbuster comme pure expérience sensitive, assemblage composite de nappes sonores et d’images hypnotiques constituant une atmosphère voluptueusement irréelle. Planante.\r\n\r\n\r\nHacker apparaît ainsi comme une anomalie totale à l’échelle hollywoodienne, un thriller au rythme languissant scandé par des séquences d’action qui puisent leur inspiration du côté du cinéma asiatique. Deux pôles d’Orient aimantent la mise en scène de Michael Mann : celui du vieil héros hong-kongais Tsui Hark, auquel on pense lors de fulgurantes scènes de fusillade ultra chorégraphiées ; et celui du Taïwanais Hou Hsiao-hsien, dont l’ouverture flottante et technoïde de Millennium Mambo semble influencer chaque plan du film.\r\n\r\nMais le prodige de Hacker est que cet accomplissement formel ne se fait pas aux dépens du récit ni de l’écriture du cinéaste, qui atteint une sophistication inédite, en particulier dans son traitement des personnages secondaires. Ils sont nombreux ici, telle cette  femme flic endeuillée par les attentats du 11 Septembre, à laquelle le film rendra hommage via un plan fugace  et bouleversant sur une tour luminescente de Hong Kong ; ou cette autre femme, complice et amante du héros, à qui Michael Mann offre la partition la plus vibrante de son Hacker. C’est grâce à elle que le personnage fantomatique de Chris Hemsworth se révèlera enfin, et accomplira dans un dernier geste la destinée de toutes les grandes figures anar et romantiques du cinéma mannien : vivre hors la loi.', '', '2016-01-14 09:52:52', 1, ''),
(2, 'Miami Vice, mon chef d''oeuvre', 'Revenant à la série qu’il avait créée, Michael Mann la magnifie pour le grand écran avec une splendide histoire d’amour impossible. Un blockbuster élégant, inventif et émouvant.\r\nPlus que la série télévisée des années 80 dont Miami Vice est l’adaptation pour le grand écran, c’est surtout avec les précédents polars de Michael Mann que la comparaison s’impose. Tant mieux.\r\n\r\nLe Solitaire, Le Sixième Sens, Heat, Révélations, Collateral, et aujourd’hui Miami Vice, Mann a signé de magnifiques thrillers urbains dans lesquels chaque élément de la mise en scène semble procéder à une déréalisation d’un matériau documentaire. Les nappes sonores et musicales, les strates d’images flottantes, les plans hypercomposés parviennent à créer des films atmosphériques et planants, véritables rêves éveillés percés d’éclairs de violence.\r\n\r\nLe cinéaste semble parfois hésiter entre l’efficacité dramatique et la quête de la pure expérience sensitive, le besoin de raconter une histoire solide avec de grands acteurs (nous sommes à Hollywood) et le désir de composer des plans vertigineux à la manière d’un peintre, d’un musicien, d’un architecte, d’un artiste. Miami Vice n’échappe pas à la règle et menace parfois de basculer dans la vacuité ornementale.\r\n\r\nMais sa beauté et son originalité, même en regard des précédents polars de Mann, sont ailleurs. On pouvait penser que Michael Mann était un cinéaste dont la forme de ses films était devenue leur sujet même. Ce n’est pas un hasard si son style s’épanouit plus particulièrement dans le néo-film noir, qui regorge d’histoires prétextes à magnifier les archétypes du polar urbain et ses nouvelles déclinaisons high-tech et contemporaines (profiler et serial killer dans Le Sixième Sens, braqueurs professionnels dans Heat, agents infiltrés chez les narcotrafiquants d’Amérique centrale dans Miami Vice).\r\n\r\nPourtant Miami Vice se révèle plus complexe. Un des thèmes du film (les réseaux internationaux des cartels de la drogue) est magnifiquement mis en scène par le cinéaste qui s’amuse à fusionner, juxtaposer ou brouiller les espaces et les ambiances, jusqu’à créer un univers dans lequel les frontières sont abolies et les personnages circulent ou communiquent en toute impunité, au-dessus des lois et des contingences.\r\n\r\nAu point que l’anonyme Miami elle-même finit par s’effacer de la topographie du film, sans qu’on s’en aperçoive vraiment, remplacée par d’autres décors de villes, de ports, de plages ou de boîtes de nuit. Après un poème dédié à Los Angeles (Collateral), Mann filme le monde comme un immense terrain de jeux pour adultes où s’échangent l’argent, la drogue, la vie et la mort. On retrouve dans Miami Vice un peu de cette fibre documentaire qui structurait les premières images du cinéaste (ses reportages, ses débuts à la télévision, et même ses séries policières), dans son ambitieux sujet géopolitique d’abord, mais aussi au détour des hallucinantes scènes de violence.\r\n\r\nLa caméra se retrouve soudain sur le siège arrière d’une voiture déchiquetée par les impacts de balles ou portée à l’épaule, à hauteur d’un fusil automatique crépitant. Pionner de la HD, Michael Mann l’utilise à nouveau avec une maîtrise et une inventivité éblouissantes en mettant à profit l’enseignement du tournage exclusivement nocturne et quasiment expérimental de son précédent film Collateral.\r\n\r\nEt nos deux flics ami-ami ? Le premier (Jamie Foxx, pas mal) suit à la ligne le cahier des charges : flic intègre, coéquipier solide, époux exemplaire, il symbolise tout à la fois un fantasme de professionnalisme total et la pure fonctionnalité propres au blockbuster hollywoodien. L’autre (Colin Farrell, très bien) va nous surprendre et nous passionner davantage (et Mann aussi). Non parce qu’il interprète le flic tête brûlée, attiré par le côté obscur de la force (classique), mais parce qu’il tombe amoureux de manière totalement irrationnelle (mais pas improbable) de la femme d’affaires trempée jusqu’au cou dans le cartel qu’il est censé démanteler, l’interlope Isabella (sublime Gong Li).\r\n\r\n\r\nEt l’on y croit à fond, car Michael Mann sait aussi filmer le désir et l’amour, toujours à deux doigts du cliché (comme Antonioni ?), et reste capable de nous émouvoir en osant des scènes extraordinaires (l’escapade à La Havane). Cette dimension romantique de l’amour impossible était déjà effleurée dans Heat (avec le personnage de De Niro), elle s’épanouit dans Miami Vice de la plus belle et inattendue façon.\r\n\r\nMIAMI VICE – DEUX FLICS À MIAMI de Michael Mann, avec Colin Farrell, Jamie Foxx, Gong Li (E.-U., 2 h 15, 2005).', '', '2016-01-14 10:33:26', 1, ''),
(3, 'Collateral, bouof...', 'Dans Collateral, deux films ne cessent de se contredire et de s’alimenter.\r\nLe premier est un blockbuster, linéaire et efficace, à la machinerie scénaristique savamment montée, mêlant scènes d’action et confrontation psychologique. Le second est une grandiose eau-forte qui transforme la ville de Los Angeles, magnifiquement filmée de nuit, en une gigantesque constellation, un chaos étrange et lumineux. \r\nDès les premières minutes, où Max, chauffeur de taxi, prend successivement à son bord Annie, une jeune avocate s’apprêtant à attaquer un baron de la drogue, et Vincent, le tueur à gages chargé d’éliminer, avant l’aube, les différents témoins à charge, ce qui pourrait n’être que languissantes scènes d’exposition explose et irradie. La caméra bascule, dans un lent va-et-vient, de plans intérieurs où la conversation fluide déroule ses répliques à d’aériens plans qui accompagnent le véhicule dans une autre circulation plus vaste et plus incontrôlable. Ce jeu entre l’intime et l’urbain définit aussitôt l’ambition de Collateral, où l’intrigue particulière est constamment plongée dans une cosmogonie qui la perce et la dépasse. \r\nA travers la relation qui s’établit entre le cynique contract killer et le gentil taxi driver, contraint de l’accompagner dans sa sanglante tournée, on devine d’ailleurs rapidement que les enjeux du film dépassent le simple cadre de la fiction. L’interrogation qui travaille Collateral est la même qui hante nombre de productions américaines depuis le 11 Septembre. Pourquoi le malheur nous a-t-il frappés ? Avons-nous commis une faute ? Qui sont les responsables ? \r\nPour Michael Mann, comme pour une majorité de ses collègues hollywoodiens, ce problème ne peut connaître de résolution qu’en le limitant d’entrée au seul territoire national. C’est précisément cet entre-nous américano-américain que désigne ici le terme de "collatéral" (Max parle de "dommage collatéral" pour qualifier sa propre prise en otage). Victimes et coupables sont tous convoqués ici dans un seul et même espace. Et il n’y a nulle coïncidence à ce que l’agenda des victimes respecte un strict panel racial : un Mexicain, un Blanc, un Noir, un Asiatique. C’est à la fois la cartographie des communautés composant aujourd’hui les Etats-Unis mais aussi la représentation sélective des diverses populations du globe ­ à l’exception notable du monde arabe.\r\nMais la "perte des valeurs" intéresse moins le réalisateur qu’une question plus vaste encore : le monde a-t-il un sens ? Respecte-t-il un plan ou n’est-il que le fruit d’un hasard aveugle ? Car ce problème métaphysique représente, pour ses compétences de metteur en scène, un véritable défi. Ce rapport complexe entre l’ordre et le désordre l’occupe tant qu’on trouve, au cœur du film, une curieuse discussion entre Vincent et un musicien noir sur l’apprentissage de Miles Davis. Avant de se lancer dans l’improvisation, apprend-on, le génial trompettiste a suivi les cours de la très classique Julliard School. De Miles à Mann, l’attitude reste en effet la même. Il faut d’abord maîtriser le standard avant de le faire dériver. En choisissant de filmer dans une mégalopole nocturne, le cinéaste essaye ainsi d’insérer le parcours attendu de ses personnages dans une toile de fond autrement plus obscure et plus indécidable. La moindre fenêtre s’ouvre ici sur l’immensité d’un néant sidéral. C’est cela qui, en dernière instance, fait le prix de Collateral ­ cette impression inattendue que le film cherche consciemment à se confronter à son autre, au grand non-sens de ce qui l’entoure, jusqu’à flirter parfois, dans un poudroiement coloré, avec la catastrophe visuelle. \r\nPatrice Blouin\r\nCollateral de Michael Mann. Avec Tom Cruise, Jamie Foxx (USA, 2003), 2 h.', '', '2016-01-14 10:36:07', 1, ''),
(4, 'Thief', 'Le Solitaire - Thief, Michael Mann (1981)\r\n\r\n\r\nÀ Chicago, Frank, bandit de haut vol, pactise avec un caïd sans foi ni loi, dans l''espoir de réaliser son rêve, fonder une famille.\r\n\r\n\r\nS''il est parvenu à signer de grands films dans des genres très divers, le polar reste le domaine de prédilection de Michael Mann et celui où chaque incursion constitua une étape charnière de sa carrière. Le Solitaire marque ses grands débuts au cinéma (après une première reconnaissance pour son téléfilm Comme un homme libre), Heat est le film de la consécration qui fera changer bien des regards sur lui et le définira pour de bon comme un auteur au yeux de la critique et Collateral sera l''oeuvre de la remise en question esthétique qui marquera les Miami Vice et Public Enemies à suivre. On peut y ajouter la série Miami Vice qu''il produisit, vrai terrain de jeu thématique et esthétique et Manhunter moins définitif mais très réussi néanmoins.\r\n\r\nLe Solitaire est pourtant le meilleur de ses polars, idéalement équilibré par rapport à l''hypertrophié Heat et au trop épuré et conceptuel Collateral ce qui n''enlèvent rien à leurs immenses qualités. La force de Thief, c''est de définirs tout les motifs visuels et thématiques mannien à l''état brut. Heat est certes plus flamboyant et stylisé, Collateral le plus immersif mais Thief s''avère plus intense et immédiat dans son côté direct, à l''image de son personnage principal. Le héros chez Michael Mann est un personnage obsessionnel, un professionnel acharné qui ne laisse aucune distraction interférer avec ses objectifs. C''est lorsqu''il se laisse gagner par une certaine humanité qu''il signe indirectement sa perte (De Niro perdant un temps précieux dans sa cavale pour sa petite amie dans Heat, Tom Cruise voyant sa détermination légèrement vaciller dans le lien qu''il noue avec Jamie Foxx dans Collateral).\r\n\r\n\r\nIci c''est James Caan braqueur professionnel et dur à cuire qui ne s''en laisse pas compter. C''est sa grande force une farouche indépendance acquise à la dure école de la prison dès le plus jeune âge et qui le rend imprévisible s''il est menacé. Pourtant le sort dramatique d''un ami encore détenu (magnifique Willie Nelson) va lui faire comprendre combien son existence est incomplète... On trouve déjà le désir d''ailleurs du héros défini par un objet innocent bien ici, avec le collage de photos fait en prison par Caan représentant sa vie rêvée avec une famille et qui anticipe celle accompagnant Jamie Foxx dans son taxi durant Collateral.\r\n\r\n\r\nDès les premières minutes la force de l''atmosphère nocturne et urbaine typique de Michael Mann frappe, la ville (Chicago) est un personnage à part entière où les héros doivent apprendre à se mouvoir avec discrétion. Les planques se font dans des box impersonnels, les rendez vous d''affaires dans des parking désertiques et les comptes se règlent dans des entrepôt sordides. Tout action au grand jour n''est que manoeuvre d''intimidation ou stratégiques (Caan allant menacer un sous fifre, les tentatives de corruptions des flics).\r\n\r\n\r\nLa maniaquerie légendaire du réalisateur apparaît dans les méticuleuse scène de cambriolage, celle ouvrant le film donne le ton mais c''est surtout la seconde à la préparation distillée dans le détail qui frappe, de la marque du coffre aux outils spécifiques fabriqués pour en venir à bout. Recrutant d''ex criminels comme conseillers sur ses plateaux (Edward Bunker himself fut dépêché sur Heat), il ne laisse aucun détail au hasard et ici la présence dans son premier rôle cinéma (en homme de main patibulaire) de l''ex flic Dennis Farina n''est sûrement pas un hasard et il retrouvera Mann dans la série Crime Story.\r\n\r\n\r\nLa vraie force de Thief repose néanmoins dans sa puissance émotionnelle. Le couple entre Tuesday Weld et James Caan est vraiment touchant et le rendez vous galant manqué virant à leur touchantes confessions respective sur leurs existences fracassée est un des plus beaux moments du film, petit bijou de séquence intimistes. N''en déplaise aux allergiques de musiques marquées 80''s, le score de Tangerine Dream (qui offriront des scores tout aussi épatant pour La Forteresse Noire) fusionne idéalement avec les tonalités urbaines métalliques de Mann, lardent de riffs de guitares martiaux les pérégrinations des personnages, mais aussi dans l''émotion lorsque des nappes de synthés viennent accompagner le seul moments apaisé du film, le bonheur simple suivant le second braquage.\r\n\r\n\r\nLa conclusion est une des plus poignantes de Mann. Sa quête de bonheur l''ayant rendu vulnérable, Caan fait tout voler en éclat dans un terrible renoncement lors d''un dernier échange poignant avec Tuesday Weld. Seul la revanche (fomidable Robert Posky en caïd odieux) peut assouvir cette douleur et c''est sous les tourbillons de guitares épiques de Craig Safian que Mann déploie un de ses gunfights les plus magistraux.', '', '2016-01-14 10:38:06', 1, ''),
(5, 'Public Enemies', 'Le film est un portrait virulent des fondements du capitalisme d’aujourd’hui, à travers la figure romantique d’un gangster un peu anar.\r\nDès les premiers plans, l’œil du spectateur subit une petite violence et doit accomplir un rapide ajustement de ses facultés. L’image de Public Enemies est d’une invraisemblable netteté. Pas une gouttelette de buée sur une vitre, pas un rayon réfléchi sur une surface miroitante au fin fond du cadre, pas une silhouette de figurant dans un plan de foule ne sont pourvus d’une définition moindre, d’un piqué inférieur, au sujet principal au centre de l’image. Avec Michael Mann, la HD (image vidéo de haute définition) a trouvé son artiste total, celui qui à chacun de ses films élargit le champ de ses possibilités techniques et surtout expressives. Collateral frappait par ses extraordinaires scènes finales dans l’obscurité complète d’un immeuble de bureaux la nuit – peut-être les plans les moins éclairés de l’histoire du cinéma, et où chaque plan émerveillait par la faculté de la caméra à voir plus que ce qu’un œil humain voit. Puis dans Miami Vice, la HD semblait rendre visible la moiteur tropicale, l’état semi-vaporeux de l’air, la lumière du soir comme un poudroiement subtil. A l’opposé de l’ambient lumineux, tamisé et doux des deux précédents films, Public Enemies impose une lumière rasante et dure. Une netteté de journal télévisé ou de vidéosurveillance high-tech, qui donne un effet de direct, un sentiment de présent (renforcé par l’utilisation de la caméra à l’épaule et des cadrages pseudo à la sauvette des scènes d’action), rarement atteint dans un film en costumes. Comme si de la superproduction rutilante et rétro attendue ne subsistaient que les images, métalliques et sèches, captées par l’équipe responsable du making of (doté, alors, d’un cadreur vraiment génial). En cela, Public Enemies est un vrai choc, un enchaînement de propositions plastiques stupéfiantes qui confirment la puissance visuelle unique de Michael Mann.\r\n\r\nAu service de quoi travaille cette dureté concertée de l’image ? D’un regard également très dur, d’un passage au scanner des raci-nes du capitalisme moderne, saisi à son point de transition entre la sauvagerie des origines et la parfaite ordonnance de son âge classique. Dillinger, le gangster à gueule d’amour (Johnny Depp), doit faire face à deux ennemis : d’un côté la paranoïa d’Etat mise en place par le directeur du FBI, Hoover, instrumentalisant les hold-up de Dillinger pour mettre en œuvre une politique de surveillance et de contrôle des populations ; de l’autre, les phénomènes de fusion et de concentration des noyaux mafieux et la montée d’une pègre organisée sur le mode des grands groupes industriels – aux antipodes donc de l’individualisme farouche et princier de Dillinger, perçu du coup par ses confrères comme une encombrante mouche du coche. C’est la notion même d’individu, de sujet libre, qui se trouve prise en étau, et si le film préfère à l’expression d’usage “ennemi public” le titre au pluriel ambigu Public Enemies, c’est que la menace publique n’est pas circonscrite, loin de là, au seul gangster. Elle tient tout autant à ceux qui tiennent les forces de la loi. Michael Mann, qui n’est pas précisément un gauchiste (lire dans l’entretien ses propos sur le confort des studios hollywoodiens et sa vindicte contre le cinéma indépendant) a pourtant réalisé un film assez teigneux, romantiquement anar, contre tout système d’organisation sociale. Si le film trouve un souffle visionnaire dans sa façon de camper une Amérique des années 30 aux allures d’une société totalitaire des romans d’anticipation de l’époque (disons Orwell), le cœur du film, à savoir Dillinger, est aussi son angle mort. Malgré le charisme inentamé (et même plutôt à son meilleur) de Johnny Depp, sa capacité à convertir le moindre geste (se gratter la joue, froncer le front…) en petit événement visuel, quelque chose échappe dans le personnage. Et le parti pris de laisser dans l’ombre son passé, ce qui le structure et le motive (la psychologie en somme) n’est pas totalement opérant. Dillinger n’est qu’une fonction, une machine à apporter de la perturbation. Et Michael Mann ne s’intéresse qu’à la mécanique, aux rouages, aux interactions entre ensembles – et moyennement aux sentiments. Il aurait fallu alors laisser tomber l’histoire d’amour, assez présente, mais peu incarnée, pas vraiment émouvante, opter pour une forme un peu plus ramassée et concise. En l’état, le film impressionne comme portrait de groupe, mais n’étreint pas complètement sa figure centrale.\r\n\r\nJusqu’à l’embuscade finale, vraiment superbe.Public Enemies plonge par deux fois son personnage principal dans une salle de cinéma. La première fois, la salle diffuse des actualités, dont un avertissement à la population concernant l’ennemi public Dillinger. La voix off du spot d’information encourage les spectateurs à regarder à droite et à gauche pour vérifier que Dillinger n’est pas parmi eux. Déjà dans L’Inconnu du Nord-Express, Hitchcock isolait un assassin dans un plan de foule : parmi les spectateurs d’un match de tennis, il était le seul à ne pas tourner la tête à gauche et à droite au rythme des balles, trop occupé à fixer l’endroit d’où pourrait surgir la police. Selon le même code visuel, Dillinger est le seul qui, dans le plan d’ensemble, n’effectue pas cette rotation moutonnière mais fixe ses chaussures.\r\n\r\nLes dernières scènes le retrouvent dans un cinéma. Il est venu voir le film noir avec Clark Gable intitulé L’Ennemi public n° 1, titre résonnant avec la façon dont la presse le nommait à l’époque. Cette fois, il est un spectateur comme un autre, regarde comme tout le monde vers l’écran. Mais avec une intensité plus forte encore, car dans cette histoire de gangster qui tourne mal, en quelques très beaux contrechamps entre le visage de Gable et celui de Depp, on comprend bien que c’est de sa propre disparition qu’il a la prescience, de l’impossibilité de son histoire d’amour aussi. Tout à coup, le pur homme d’action, épinglé sur son siège, est débordé par un affect violent, un affect de spectateur. Il est tout à coup vulnérable, piégé par le cinéma : et il faut bien une telle mise en abyme au très cérébral Michael Mann pour que son film devienne soudainement bouleversant.', '', '2016-01-14 10:39:16', 1, ''),
(6, 'Heat', 'Avec Heat, un duel Pacino/De Niro stylisé, l’ambivalent et sous-estimé Michael Mann pourrait bien s’imposer comme le plus digne successeur d’Howard Hawks. La thématique des films criminels de celui qui fut le premier à porter à l’écran le plus fameux des serial-killers, Hannibal Lecter, tient en une question : comment saisir l’essence du mal sans perdre la tête ?\r\nLe malheur de Michael Mann demeure son succès interplanétaire. Longtemps maudit comme metteur en scène ­ qui se souvient de Comme un homme libre ? Y avait-il seulement un Français dans la salle où était projeté La Forteresse noire ? ­, il semble pourtant que les dieux de l’Olympe se soient penchés sur son berceau pour bénir sa carrière de producteur télé. Celle-ci est exceptionnelle, au sens où l’entend Wall Street : extrêmement lucrative. En un mot, professionnelle.\r\n\r\nDurant les années 70-80, la marque Michael Mann a été, pour les grands réseaux, synonyme d’assurance tous risques. En trois séries télé, Starsky et Hutch, Deux flics à Miami et Crime story, Mann a établi des standards dont le film criminel américain a abusé jusqu’à l’éc’urement. Alors que Crime story n’a atteint les écrans français qu’en catimini (notamment les deux premiers épisodes, remarquables, réalisés par Abel Ferrara sous le titre Les Incorruptibles de Chicago), Starsky et Hutch et Deux flics à Miami sont connus de tous ceux qui ont tourné au moins une fois dans leur vie le bouton de leur télévision. Starsky et Hutch et Deux flics à Miami sont imprégnés d’une bêtise et d’une esthétique contre lesquelles on serait tenté de jeter l’anathème. Le couple de flics liés viscéralement comme les deux faces d’une même pièce, le polar surchargé de filtres bleu, orange et fluo, une bande FM omniprésente où trônent Phil Collins et Glenn Frey, une esthétique MTV reprenant au clip ses effets de montage et une ribambelle de personnages aux cheveux parfaitement cisaillés, portant costume Armani et chaussures Emilio Zegna comme pour satisfaire à un rituel fixé à l’avance : autant de codes propres à un nouveau type de film criminel, propre, structuré, collant parfaitement aux années 80 où gangsters et flics côtoient le stupre et la luxure, se couchent dans la soie et se réveillent dans une piscine en marbre.\r\n\r\nIncarnation d’un fantasme des années 80, la patte clinquante et fluo de Mann, scandée par le son des boîtes à rythmes, devient dès qu’elle passe sur le grand écran la marque d’un réalisme soigné à l’extrême. Il serait idiot d’ironiser sur le visage glabre, presque juvénile, de James Caan dans Le Solitaire, ou sur les allures de prince vénitien de De Niro dans Heat. Il n’y a pas ce fantasme du gangster chez Mann, comparable à celui qui pouvait, par exemple, habiter Melville. Mann porte un point de vue anthropologique sur ce que l’on pourrait nommer l’aristocratie du gangstérisme, le criminel de première classe, le perceur de coffres-forts viscontien qui troque son bleu de travail contre le costume sur mesure. Cette stylisation est le fruit d’un travail minutieux entrepris il y a près de vingt ans, lorsque Mann avait suivi à la trace un perceur de coffres-forts avant de tourner Le Solitaire. Cette même méthode prévaut dans Heat, reconstitution d’un fait divers authentique mettant aux prises un flic obsédé avec un braqueur de génie sur lesquels Mann avait accumulé une documentation considérable. Avec Heat, le cinéaste met le point final à une chronique s’étendant sur plus d’un demi-siècle, consacrée à une corporation élitiste et distinguée : les perceurs de coffres-forts.\r\n\r\nPour l’establishment de la critique, notamment française, Michael Mann n’existe pas. Il reste aussi évanescent que ce perceur de coffres-forts équipé d’un cerveau de surdoué qu’interprète Robert De Niro dans son nouveau film. Rares sont ceux qui ont réussi à localiser Michael Mann, alors que Heat démontre l’urgence de le remettre aujourd’hui à sa place. Plus que Tarantino, Mann est à l’heure actuelle le plus digne successeur d’Hawks, prolongeant la thématique de ses films criminels, de Scarface à The Criminal code, pour confronter celle-ci à l’épreuve du quotidien.\r\n\r\nIl n’y a pas plus hawksien que les deux protagonistes de Heat, professionnels jusqu’au bout des ongles : McCauley (Robert De Niro), le génie du casse minuté conçu avec la même maestria que les plans d’hélicoptère de Leonard de Vinci ; et Vince Hanna (Al Pacino), un flic dont le flair métaphysique est un défi lancé aux manuels de logique, alors que l’acharnement viscéral qu’il manifeste dans le travail est susceptible de décourager toute nouvelle recrue persuadée que la défense de la veuve et de l’orphelin est uniquement un travail de jour. Heat explore le revers du professionnalisme hawksien, poussant jusqu’à la limite les principes du metteur en scène de Scarface. La femme d’Hanna ne cesse de le comparer au cours du film à un mort-vivant, et la devise de McCauley ­ ne jamais s’attacher à qui que ce soit pour être en mesure de mettre les voiles en moins de trente secondes ­ pourrait être celle d’un spectre. Le rapport au monde d’Hanna et McCauley est du même ordre que celui du fantôme avec madame Muir dans le film de Mankiewicz avec Gene Tierney. Lors de leur seule rencontre, dans un coffee-shop anonyme, devant un café sans goût, McCauley et Hanna s’aperçoivent qu’ils font les mêmes rêves morbides, hantés par une fin imminente où se profile la même obsession du temps qui passe. En poussant à bout la logique du professionnalisme hawksien, Mann obtient des personnages qui n’ont justement plus rien d’autre à exhiber que ce professionnalisme : aucune vie privée ­ “Tu vis comme un moine ?”, demande Hanna à McCauley ­, une famille partant en lambeaux et une existence somme toute foirée.\r\n\r\nPlutôt que de voir dans les personnages interprétés par De Niro et Pacino la résurgence de vieux archétypes du film noir, revenant d’un au-delà cinéphilique d’où pourraient être extraits la figure de Delon dans Le Samouraï, le visage névrotique de Gene Hackman dans French connection ou la silhouette de Glenn Ford dans Règlement de comptes, il vaudrait mieux prendre McCauley et Hanna à la lettre, littéralement issus d’entre les morts, c’est-à-dire désincarnés, sans sève, incapables de vivre avec leur entourage, maniant fusil et foreuse à défaut d’autre chose.\r\n\r\nChez Mann, la mise en scène se définit comme un exercice de haute précision où la caméra, telle une perceuse électronique équipée d’un scanner, a pour fonction de forcer un coffre-fort qui n’est rien d’autre que le cerveau. Inutile d’aller chercher dans Heat la rencontre De Niro/Pacino, elle n’aura pas lieu. Ou si peu. C’est une des gageures du film. Pacino ne recherche pas une entité physique destinée à moisir dans la moiteur d’un pénitencier, mais un cerveau. C’est bien aux neurones de De Niro qu’il se cramponne. Leur première rencontre se fait par scanner interposé, un soir de filature où Hanna saisit McCauley en ombre fluorescente, tel Satan pris la main dans le sac, perçu dans sa plus stricte intimité, dépouillé cette fois-ci de ses parures princières et laissant apparaître sa nature maléfique. Une telle préoccupation est symptomatique de la veine la plus fructueuse du film noir américain des années 80-90, toute tournée vers une description clinique du crime ­ comme s’il s’agissait de mieux débusquer le mal à l’intérieur de l’être. Ce sont les scanners du cerveau du serial-killer dans Le Sang du châtiment de William Friedkin, montrés au spectateur dans une volonté d’objectiver le mal, ou les méandres existentiels dans lesquels plonge Lili Taylor dans The Addiction d’Abel Ferrara, persuadée que l’expérience du mal est un préalable nécessaire à sa connaissance. C’était aussi le propos du Sixième sens, le film le plus complexe de Mann, où un ancien psychologue de la police possédait la faculté exceptionnelle de pouvoir saisir les moindres soubresauts du cerveau d’un serial-killer et d’anticiper ses crimes futurs. On regrettera toujours la bêtise du titre français, éclipsant le titre original du film : avec Man hunter en tête, on comprend mieux le projet tordu de Mann, qui incluait de manière paronomastique son nom dans la matière même de son film, s’acharnant à débusquer les méandres de sa propre psyché. Dans Man hunter, Michael était lancé à la recherche de Mann.\r\n\r\nLa femme d’Hanna/Pacino lui dit qu’il vit parmi les morts. Pourquoi vos personnages sont-ils éloignés de la vie ?\r\n\r\nJe comparerais le travail que j’ai effectué en préparant Heat à celui d’un journaliste. D’un point de vue sociologique, c’est un film très véridique. Toutes les grandes villes américaines possèdent deux ou trois flics extrêmement doués, dotés d’un flair hors du commun. J’ai pris modèle sur deux flics en particulier : l’un s’appelle C. Adamson, l’autre travaille pour la DEA (Drug Enforcement Agency, l’équivalent américain de la brigade des stupéfiants). Hanna est donc un personnage réaliste. Pareil pour Chris Shiherlis, l’adjoint de McCauley. Je m’attache à des criminels de la Côte Ouest qui sortent de prisons de la Côte Ouest : ils n’ont rien à voir avec leurs homologues à New York ou Chicago. Ils se démarquent de ces derniers de manière étrange, il existe encore chez eux des principes et des gestes remontant à l’Ouest ancien. La plupart des voleurs ou cambrioleurs de la Côte Ouest sont indépendants, il y a encore un côté Jesse James chez eux. Si vous exercez la même profession à New York ou Chicago, vous ne pouvez pas vous offrir ce luxe, vous êtes obligé d’avoir des liens étroits avec le crime organisé qui vous force à revendre le fruit de vos cambriolages à des receleurs agréés.\r\n\r\nVotre film met en scène deux générations de gangsters : d’un côté, McCauley ; de l’autre, son jeune adjoint, interprété par Val Kilmer. Quelles différences peut-on dresser entre ces générations ?\r\n\r\nIl y a trois générations d’anciens prisonniers. Je connais bien la prison : mon premier film, Comme un homme libre, se déroulait entièrement dans le pénitencier de Folsom, d’où De Niro est censé sortir dans Heat. J’ai retrouvé pour l’occasion les mêmes prisonniers que j’avais rencontrés au moment où je préparais Comme un homme libre. Ils étaient un peu plus vieux, se souvenaient parfaitement de moi. Curieusement, en quinze ans, l’état des prisons s’est amélioré du point de vue du confort : Folsom a une bien meilleure gueule aujourd’hui. Mais c’est aussi devenu un endroit plus inhumain, il n’y a plus de programme de réinsertion ; seulement de belles cellules, propres et bien dessinées, destinées à accueillir des prisonniers traités comme des paquets de viande.\r\n\r\nHeat s’inspire d’une histoire vraie. Quel type de recherches avez-vous effectuées avant de tourner le film ?\r\n\r\nC. Adamson, détective à Chicago, est l’un de mes meilleurs amis. Il a fait la connaissance du vrai Neil McCauley en 1963 avant de l’abattre ­ durant un vol à main armée. Peu de temps avant, ils s’étaient vus dans un café et avaient discuté un bon bout de temps ensemble. Les motivations d’Adamson au cours de cette discussion étaient strictement d’ordre professionnel, il s’agissait pour lui de glaner n’importe quelle information aussi insignifiante fût-elle : la manière dont McCauley tient sa tasse de café, les prisons qu’il a fréquentées, des petits détails sur sa vie privée. Il peut vous donner un élément d’information qui, trois mois plus tard, vous sera très utile pour anticiper ses faits et gestes. C’est exactement ce qui se produit dans le film (voir photo). De Niro dit à Pacino, sans même faire attention, “J’ai une femme dans ma vie.” Un peu plus tard, lorsque De Niro déclenche l’alarme dans l’hôtel, Pacino aperçoit une fille seule dans une voiture et il devine intuitivement qu’il s’agit de la compagne de McCauley. Pour revenir à la réalité, Adamson, lors de sa rencontre avec le vrai McCauley, m’avait dit être fasciné par sa discussion avec lui alors qu’il ne s’attendait pas à trouver un type aussi passionnant et, très vite, leur conversation avait tourné autour du fait que l’un des deux allait fatalement tuer l’autre.\r\n\r\n\r\nComment expliquez-vous que votre carrière de producteur télé ait remporté autant de succès comparé à votre parcours de metteur en scène où, jusqu’au Dernier des Mohicans et Heat, vous avez accumulé les échecs ?\r\n\r\nJ’ai mis beaucoup de temps à devenir intelligent. Après Le Sixième sens, j’ai pris la décision de ne réaliser un film que si celui-ci était distribué par une compagnie puissante capable d’en assurer le marketing et la publicité. Il n’y aurait pas eu la Fox, je n’aurais jamais fait Le Dernier des Mohicans. Le problème du Solitaire et du Sixième sens était qu’ils étaient distribués par des compagnies fragiles, sujettes à des changements de staff. Cela dit, même soutenu par un grand studio, je vois mal comment un film comme Le Solitaire aurait pu marcher.\r\n\r\nVous avez tourné votre premier film à Paris durant Mai 68.\r\n\r\nJ’étais étudiant en cinéma à Londres lorsque les troubles sont survenus à Paris. Il me semblait capital d’y aller pour voir ce qui se passait. De plus, les grands networks américains, CBS, ABC, NBC, n’arrivaient pas à couvrir l’événement, Daniel Cohn-Bendit, Alain Geismar et Alain Krivine refusaient de parler à leurs journalistes. J’ai réussi à convaincre NBC de faire là-bas le reportage pour eux. Je leur ai envoyé mes bobines qu’ils ont montées à New York et le documentaire a été montré la même année. Je ne l’ai pas revu depuis.\r\n\r\nPourquoi êtes-vous parti étudier le cinéma à Londres ?\r\n\r\nA cause de la guerre du Vietnam. Et aussi parce qu’à l’époque il y avait très peu d’écoles de cinéma aux Etats-Unis. De plus, leur enseignement était très technique. Les cours à Londres enseignaient le cinéma comme un art et pas seulement comme un moyen de tourner des films publicitaires ou commerciaux. Je n’ai pris la décision de devenir metteur en scène qu’à 21 ans. Jusque-là, je voulais enseigner la littérature anglaise. J’aurais sans douté été très malheureux en choisissant cette option. Tout a changé pour moi le jour où j’ai vu Faust de Murnau et La Rue sans joie de Pabst. Deux films très différents. Le premier est expressionniste et très formel, le second est plus réaliste. Murnau m’a fait comprendre à quel point ce médium pouvait être puissant, combien il pouvait affecter le point de vue du spectateur. J’ai vu L’Aurore pour la première fois l’année dernière ­ un film méconnu aux Etats-Unis alors qu’il me semble indispensable pour comprendre la République de Weimar. En outre, la grande leçon de L’Aurore, c’est le style d’un auteur qui influence la structure narrative de l’histoire.\r\n\r\nQu’est-ce qui vous a attiré dans Red dragon, le roman de Thomas Harris que vous avez adapté pour Le Sixième sens ?\r\n\r\nIl s’agit d’un livre extraordinaire. Il arrivait à vous faire comprendre à quel point il est affreux de tuer quelqu’un. On a du mal à le concevoir quand on voit un meurtre au cinéma ou lorsqu’on lit les statistiques dans les journaux. J’ai rarement vu un livre de fiction saisir cette horreur, alors que la vie est une chance incroyable, très brève, relevant du hasard. Thomas Harris arrivait à prendre un point de vue objectif sur le meurtre, dépassionné, impersonnel, pour inventer un personnage malade tuant à la chaîne. La seconde force du livre résidait dans cet autre protagoniste, Will Graham, qui n’a pas de filtre : s’il se retrouve en face d’un psychopathe, il devient malade car son imagination n’a pas de limites. Le problème de Graham se trouvait dans cette question : peut-on saisir l’essence du mal et, si oui, comment le faire sans perdre la tête ? C’est ce dilemme que j’ai essayé de restituer à l’écran.\r\n\r\nCette question était déjà présente dans La Forteresse noire qui, au travers d’un film d’horreur gothique, essayait d’analyser la nature profonde du nazisme et du fascisme.\r\n\r\nJe voulais faire un film sur les origines psychologiques du fascisme, sur sa nature, sur l’appel qu’il peut exercer sur beaucoup de gens. En ce sens, il est très proche du conte de fées. J’insiste sur le conte de fées car, à l’inverse des fables, les contes de fées font appel à l’inconscient. J’ai toujours pensé que si vous avez un grand intérêt pour les fables, vous êtes un behavioriste ; alors que si vous êtes attiré par les contes de fées, vous êtes définitivement freudien. La Forteresse noire se voulait l’adaptation du livre de Bettelheim, Psychanalyse des contes de fées. Je parle à l’imparfait parce que mon film a été massacré au montage et mon propos initial a été en grande partie déformé. J’essayais de débusquer l’universalité des impulsions fascistes. Le fascisme n’était pas seulement perçu comme un mouvement politique, mais aussi comme une donnée psychologique à laquelle certains individus sont plus sujets que d’autres. Un autre livre m’a influencé : The Mind of Adolf Hitler de Walter Wanger. Lui et une équipe de psychanalystes avaient été engagés en 1942 par la CIA sur l’ordre de Roosevelt, qui voulait que des psychanalystes fassent une analyse d’Hitler ­ il voulait mieux connaître son ennemi. Wanger dressait ainsi le portrait d’un individu doté d’un ego schizophrène, ne possédant aucun amour-propre, et montre comment son ascension ne se conçoit qu’en détruisant les autres. Dresser ainsi un tel portrait d’Hitler permet de mieux comprendre les raisons de l’émergence du fascisme en Allemagne, en Italie, en France et, dans une certaine mesure, en Angleterre. Il existe pour moi un parallèle très clair entre La Forteresse noire et le personnage de Dollarhyde, le serial-killer du Sixième sens : la psychologie de Dollarhyde n’est pas aberrante, elle ne vient pas non plus d’une autre planète. Dollarhyde est un cousin lointain.', '', '2016-01-14 10:41:24', 1, ''),
(7, 'Ali', 'Dans la carrière de Michael Mann, Ali tient une place à part, mais ce qui ne veut pas dire qu’il n’y trouve pas une place. Bien au contraire, ce biopic qui évoque quelques années de la vie du boxeur de Cassius Clay, alias Mohammed Ali, est l’œuvre d’un véritable auteur. Loin du classicisme de Hollywood, c’est un long-métrage avec une vraie vision que nous offre le réalisateur, et quelle vision. Des matchs de boxe d’un réalisme rare, un acteur au sommet et une plongée fascinante dans une époque : Ali est une réussite complète, passionnante d’un bout à l’autre. À voir absolument, pas forcément pour son sujet, mais plus pour son scénario parfaitement mené et sa maîtrise technique.\r\n\r\nali-michael-mann\r\nD’emblée, Michael Mann rejette les codes du biopic et le réalisateur choisit de commencer exactement au moment où la carrière de Cassius Clay va atteindre son apogée. Le jeune boxeur n’a que 22 ans et déjà un jeu hors-pair : il écrase tous ses ennemis et arrive facilement à la finale du monde des poids-lourds. La première séquence d’Ali juxtapose précisément ce match avec un concert qui signale dans la foulée l’importance de la musique dans le film, mais aussi quelques flashbacks. Même si le film ne suit pas chronologiquement toute la vie de son sujet, une scène ou deux suffisent à Michael Mann pour poser son personnage. On est au cœur des années 1960, dans un pays encore légalement raciste et l’une de ces séquences montre le jeune Cassius dans un bus séparé en deux. Une scène très forte qui suffit, sans la moindre ligne de dialogue, à présenter un contexte difficile et surtout commencer à construire le caractère du personnage. Sa volonté tenace de revanche et de victoire, elle naît en partie dans ce bus complètement bondé dans la partie réservée aux personnes de couleur. Et elle naît quand le futur boxeur pose les yeux sur un article qui évoque la mort atroce d’un afro-américain, lapidé par des blancs. Même si Ali ne se politise jamais vraiment, son scénario n’évite pas les sujets difficiles. Discrimination raciale, mais aussi religieuse quand Ali, devenu champion du monde de boxe, se convertit à l’Islam. Comme toujours, Michael Mann glisse des éléments qui expliquent sa conversion, sans jamais tomber dans le didactisme lourd. On comprend que le sportif rejette son éducation catholique qui invitait à accepter la discrimination et à ne pas répondre. L’assassinat de son ami Malcom X le pousse ensuite dans les bras des Musulmans les plus intégristes du moment qui le poussent à se débarrasser de sa première femme. Mais le personnage principal d’Ali conserve malgré tout son mystère et on ne sait plus très bien pourquoi il revient vers ces Musulmans qui l’ont rejeté à la première défaite. Et puis est-il vraiment croyant ou ne s’agit-il que de protester contre une société ? Il concilie très bien sa foi avec de multiples conquêtes féminines et Michael Mann instaure un petit peu plus de doute quand il laisse entendre que le boxeur est surtout intéressé par l’argent des Black Muslims.\r\n\r\nmichael-mann-ali\r\nAli lance des pistes et des questions, sans jamais répondre de manière péremptoire et surtout avec beaucoup de subtilité dans la mise en scène. Là où bon nombre de cinéastes auraient ajouté des séquences lourdement explicatives, Michael Mann préfère glisser des pistes, sans affirmer, mais en suggérant. Il parie ainsi sur l’intelligence des spectateurs et cela paye : au premier niveau, le film évoque surtout les combats du boxeur sur le ring, mais il laisse entendre suffisamment de choses pour qu’on ait l’impression de voir un film historique. Par moment, le réalisateur touche le documentaire, un effet paradoxalement obtenu par son utilisation d’une caméra numérique ultra-moderne, mais aussi très granuleuse. Il convient aussi de saluer la performance exceptionnelle de Will Smith : l’acteur s’est rarement illustré pour la réussite de ses prestations, mais il a indéniablement trouvé un grand rôle en incarnant Mohammed Ali. Il faut dire qu’il a donné de sa personne, avec perte de poids et surtout entraînement intensif de boxe. C’est bien lui qui est sur le ring, face à d’anciens champions de boxe, et c’est bien lui, et non des doublures, qui prend des coups. Michael Mann aurait certainement pu faire différemment, mais cette stratégie paye elle aussi : on a rarement vu des séquences de boxe aussi violentes, réalistes et haletantes que celle que l’on voit dans Ali. Il n’y en a pas tant que ça en fait, quatre ou cinq matchs de boxe en tout alors que le film dure près de deux heures quarante dans sa version définitive. Elles sont assez rares, mais très fortes et elles constituent le point d’orgue du long-métrage, à tel point que tout le monde sera happé par le suspense. Inutile d’être fan de boxe, les acteurs et la mise en scène de Michael Mann suffit à susciter l’intérêt : chapeau ! Pour compléter le tout, la bande-originale du film composée de divers morceaux d’époque est une vraie réussite. Elle accompagne le récit, de la musique afro-américaine dans un premier temps à la musique africaine dans la deuxième partie, et tous les morceaux sont bien choisis et parfaitement intégrés au long-métrage.\r\n\r\nali-mann\r\nFranche réussite que ce biopic qui refuse les poncifs de la catégorie. Ali n’est probablement pas le meilleur film sur Mohammed Ali, en tout cas pas si l’on veut tout connaître sur le boxeur. Néanmoins, Michael Mann propose un vrai personnage de cinéma, et un personnage passionnant. En suivant le boxeur pendant une dizaine d’années, le long-métrage propose des séquences de boxe d’un réalisme et surtout d’une intensité rares, tout en plongeant le spectateur dans une époque et un contexte social. Ali est prenant, filmé avec beaucoup de talent et son acteur principal est bluffant. Autant d’éléments qui en font un grand film, à (re)voir !', '', '2016-01-14 11:25:44', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table options des utilisateurs';

--
-- Contenu de la table `options`
--

INSERT INTO `options` (`id`, `data`, `value`) VALUES
(1, 'nom', 'mann'),
(2, 'prenom', 'michael'),
(3, 'telephone', '0561810000'),
(4, 'email', 'michael.mann.the.god.of.cinema@gmail.com'),
(5, 'avatar', 'mm.jpg'),
(6, 'titre', 'Michael Mann, Dieu du Cinéma'),
(7, 'slider_1', '1452870587-heatmm.jpg'),
(8, 'slider_2', '1452870587-thiefmm.jpg'),
(9, 'slider_3', '1452870587-ennemiesmm.jpg'),
(10, 'slider_4', '1452870587-miamivice.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des rôles des utilisateurs';

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tokens';

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table utilisateurs';

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `nickname`, `password`, `id_role`) VALUES
(1, 'admin@test.fr', 'pseudoAdmin', '$2y$10$FGmEj9DT8a9TMKGEBZ9ciOzmUeSdoWF1g/hg0ajOanFfImKzGZUHa', 1),
(2, 'user@test.fr', 'pseudoUser', '$2y$10$JCMcctNAKDwAByoOzMybPuQKu8ilf7eh7n61zzQjqraMFDsoDxqhC', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

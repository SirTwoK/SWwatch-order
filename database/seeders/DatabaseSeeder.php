<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $entries = [];
        $order = 1;

        $add = function (array $data) use (&$entries, &$order) {
            $entries[] = array_merge([
                'order'              => $order++,
                'thumbnail_color'    => '#1a2030',
                'thumbnail_url'      => null,
                'thumbnail_position' => 'center',
                'synopsis'           => null,
                'watched'            => false,
                'created_at'         => now(),
                'updated_at'         => now(),
            ], $data);
        };

        // ══════════════════════════════════════════════════════════════════
        // REPUBLIC ERA
        // ══════════════════════════════════════════════════════════════════

        $add(['title' => 'The Phantom Menace', 'type' => 'film', 'series_name' => null, 'season' => null, 'episode' => null, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '32 BBY', 'duration_minutes' => 136, 'recommendation' => 'must', 'thumbnail_color' => '#1a3a2a', 'synopsis' => 'The Trade Federation blockades Naboo, forcing two Jedi and a young boy with an extraordinary midi-chlorian count into an unlikely alliance.']);
        $add(['title' => 'Attack of the Clones', 'type' => 'film', 'series_name' => null, 'season' => null, 'episode' => null, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 142, 'recommendation' => 'must', 'thumbnail_color' => '#2a1a1a', 'synopsis' => 'An assassination attempt on Senator Amidala leads Obi-Wan to discover a secret clone army, while Anakin and Padme\'s forbidden romance blossoms.']);

        // Tales of the Jedi episodes 1-4
        $add(['title' => 'Life and Death', 'type' => 'series', 'series_name' => 'Tales of the Jedi', 'season' => 1, 'episode' => 1, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '35 BBY', 'duration_minutes' => 14, 'recommendation' => 'must', 'thumbnail_color' => '#2a2a1a', 'synopsis' => 'The origin of Ahsoka Tano. Born on Shili, her first encounter with the Force as an infant during a hunt.']);
        $add(['title' => 'Justice', 'type' => 'series', 'series_name' => 'Tales of the Jedi', 'season' => 1, 'episode' => 2, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 14, 'recommendation' => 'must', 'thumbnail_color' => '#2a2a1a', 'synopsis' => 'Count Dooku and his Padawan Qui-Gon Jinn investigate the kidnapping of a senator\'s son and confront a corrupt system.']);
        $add(['title' => 'Choices', 'type' => 'series', 'series_name' => 'Tales of the Jedi', 'season' => 1, 'episode' => 3, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 14, 'recommendation' => 'must', 'thumbnail_color' => '#2a2a1a', 'synopsis' => 'Dooku is confronted with the corruption of the Senate after a Senator is murdered. A pivotal moment in his fall to the dark side.']);
        $add(['title' => 'The Sith Lord', 'type' => 'series', 'series_name' => 'Tales of the Jedi', 'season' => 1, 'episode' => 4, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 14, 'recommendation' => 'must', 'thumbnail_color' => '#2a2a1a', 'synopsis' => 'Yaddle discovers the truth about Dooku\'s allegiance to Darth Sidious and pays a terrible price for it.']);

        // Tales of the Underworld episodes 4-6
        $add(['title' => 'Asajj Ventress', 'type' => 'series', 'series_name' => 'Tales of the Underworld', 'season' => 1, 'episode' => 4, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#1a1a2a', 'synopsis' => 'An anthology story from the Star Wars criminal underworld featuring Asajj Ventress.']);
        $add(['title' => 'Cad Bane', 'type' => 'series', 'series_name' => 'Tales of the Underworld', 'season' => 1, 'episode' => 5, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#1a1a2a', 'synopsis' => 'An anthology story featuring the galaxy\'s most feared bounty hunter, Cad Bane.']);
        $add(['title' => 'Hondo Ohnaka', 'type' => 'series', 'series_name' => 'Tales of the Underworld', 'season' => 1, 'episode' => 6, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#1a1a2a', 'synopsis' => 'An anthology story featuring the charming pirate Hondo Ohnaka navigating the criminal underworld.']);

        // ── CLONE WARS ────────────────────────────────────────────────────
        $cw = function (string $title, int $season, int $ep, string $rec, string $synopsis = '') use (&$add) {
            $add(['title' => $title, 'type' => 'series', 'series_name' => 'The Clone Wars', 'season' => $season, 'episode' => $ep, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 22, 'recommendation' => $rec, 'thumbnail_color' => '#1a2a3a', 'synopsis' => $synopsis]);
        };

        $cw('Cat and Mouse', 2, 16, 'must', 'Anakin must use a prototype stealth ship to break a Separatist blockade and deliver supplies to a besieged planet.');
        $cw('Hidden Enemy', 1, 16, 'must', 'Obi-Wan and Anakin discover a traitor among their clone troops before the events of the theatrical film.');
        $add(['title' => 'The Clone Wars — Theatrical Film', 'type' => 'film', 'series_name' => null, 'season' => null, 'episode' => null, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '22 BBY', 'duration_minutes' => 98, 'recommendation' => 'must', 'thumbnail_color' => '#0a1a2a', 'synopsis' => 'Anakin and his new Padawan Ahsoka Tano must rescue Jabba the Hutt\'s kidnapped son to secure a crucial alliance.']);
        $cw('Clone Cadets', 3, 1, 'must', 'Five clone cadets struggle to complete their training and earn their place among the Republic\'s elite soldiers.');
        $cw('Supply Lines', 3, 3, 'skip', 'Jar Jar Binks and Bail Organa negotiate with the Toydarians to secure supplies for a besieged planet.');
        $cw('Ambush', 1, 1, 'must', 'Yoda and a small squad of clones must face Ventress and her massive droid army to prove the Jedi\'s worth as allies.');
        $cw('Rising Malevolence', 1, 2, 'recommended', 'Anakin and Ahsoka race to rescue survivors of a Separatist attack involving Grievous\'s devastating new weapon.');
        $cw('Shadow of Malevolence', 1, 3, 'recommended', 'Anakin leads a bold Y-wing strike mission against General Grievous and the Malevolence.');
        $cw('Destroy Malevolence', 1, 4, 'recommended', 'Padme and C-3PO are captured aboard the Malevolence as Anakin and Obi-Wan race to destroy the ship.');
        $cw('Rookies', 1, 5, 'must', 'Fresh clone troopers must defend a remote listening post against a commando droid attack, alone.');
        $cw('Downfall of a Droid', 1, 6, 'skip', 'R2-D2 goes missing in battle and Anakin must find him before his memory is extracted by the Separatists.');
        $cw('Duel of the Droids', 1, 7, 'skip', 'Anakin and Ahsoka infiltrate a Separatist outpost to recover R2-D2, leading to a showdown between astromechs.');
        $cw('Bombad Jedi', 1, 8, 'skip', 'Jar Jar Binks accidentally becomes a hero when Padme is captured on a Separatist-controlled planet.');
        $cw('Cloak of Darkness', 1, 9, 'recommended', 'Ahsoka and Luminara escort a captured Nute Gunray, but Ventress has other plans.');
        $cw('Lair of Grievous', 1, 10, 'recommended', 'Kit Fisto and his former Padawan are lured into General Grievous\'s terrifying stronghold.');
        $cw('Dooku Captured', 1, 11, 'must', 'Anakin and Obi-Wan discover Count Dooku has been captured by pirates and must decide whether to rescue him.');
        $cw('The Gungan General', 1, 12, 'recommended', 'Obi-Wan, Anakin, and Dooku must reluctantly work together to escape pirate captivity.');
        $cw('Jedi Crash', 1, 13, 'recommended', 'Anakin is critically wounded and Ahsoka must keep him alive while stranded on a pacifist planet.');
        $cw('Defenders of Peace', 1, 14, 'recommended', 'The pacifist Lurmen must decide whether to fight back against a Separatist superweapon test.');
        $cw('Trespass', 1, 15, 'recommended', 'Anakin and Obi-Wan are caught in a territorial dispute on an ice planet between a senator and indigenous warriors.');
        $cw('Blue Shadow Virus', 1, 17, 'skip', 'A Separatist scientist threatens to unleash a deadly virus. Padme and Ahsoka are captured in the lab.');
        $cw('Mystery of a Thousand Moons', 1, 18, 'skip', 'Anakin and Obi-Wan race to find the antidote to the Blue Shadow Virus before it kills Padme and Ahsoka.');
        $cw('Storm over Ryloth', 1, 19, 'must', 'Ahsoka must overcome a costly mistake and devise a daring plan to break the Separatist blockade of Ryloth.');
        $cw('Innocents of Ryloth', 1, 20, 'must', 'Obi-Wan and the clones must liberate a Twi\'lek village used as a droid shield without harming civilians.');
        $cw('Liberty on Ryloth', 1, 21, 'must', 'Mace Windu teams with freedom fighter Cham Syndulla to liberate Ryloth\'s capital from Separatist occupation.');
        $cw('Holocron Heist', 2, 1, 'must', 'Cad Bane infiltrates the Jedi Temple to steal a holocron at Darth Sidious\'s request.');
        $cw('Cargo of Doom', 2, 2, 'recommended', 'Anakin and Ahsoka pursue Cad Bane to recover the stolen holocron, putting a Jedi youngling at risk.');
        $cw('Children of the Force', 2, 3, 'recommended', 'The Jedi discover Sidious\'s plan to kidnap Force-sensitive children and train them as spies.');
        $cw('Bounty Hunters', 2, 17, 'recommended', 'Obi-Wan, Anakin and Ahsoka team up with bounty hunters to defend a village from Hondo\'s pirates.');
        $cw('The Zillo Beast', 2, 18, 'recommended', 'A Republic battle awakens a massive ancient creature whose hide is impervious to lightsabers.');
        $cw('The Zillo Beast Strikes Back', 2, 19, 'recommended', 'The Zillo Beast escapes on Coruscant, rampaging toward the Senate building while Palpatine watches.');
        $cw('Senate Spy', 2, 4, 'recommended', 'Padme is asked to spy on a former flame who may be conspiring with the Separatists.');
        $cw('Landing at Point Rain', 2, 5, 'must', 'Anakin, Obi-Wan and Ki-Adi-Mundi lead a massive assault on a droid factory on Geonosis.');
        $cw('Weapons Factory', 2, 6, 'must', 'Ahsoka and Luminara\'s Padawan Barriss are trapped inside an exploding Separatist droid factory.');
        $cw('Legacy of Terror', 2, 7, 'must', 'Obi-Wan and Luminara investigate Geonosis catacombs and encounter a Geonosian zombie hive mind.');
        $cw('Brain Invaders', 2, 8, 'must', 'Ahsoka must stop a Geonosian brain worm infestation from spreading through a medical vessel, including inside Barriss.');
        $cw('Grievous Intrigue', 2, 9, 'skip', 'Obi-Wan risks capture to rescue a Jedi Master held hostage by General Grievous.');
        $cw('The Deserter', 2, 10, 'must', 'Rex discovers a clone who deserted the army and started a family, forcing him to question what it means to be a soldier.');
        $cw('Lightsaber Lost', 2, 11, 'recommended', 'Ahsoka\'s lightsaber is stolen in the Coruscant underworld. She teams with an elderly Jedi to track it down.');
        $cw('The Mandalore Plot', 2, 12, 'must', 'Obi-Wan investigates a Mandalorian conspiracy and meets Duchess Satine, an old flame.');
        $cw('Voyage of Temptation', 2, 13, 'must', 'Obi-Wan escorts Duchess Satine to Coruscant while assassins lurk aboard the ship.');
        $cw('Duchess of Mandalore', 2, 14, 'must', 'Satine fights to prevent the Senate from invading Mandalore as a Death Watch conspiracy closes in.');
        $cw('Death Trap', 2, 20, 'skip', 'Young Boba Fett infiltrates a Republic cruiser disguised as a clone cadet to get revenge on Mace Windu.');
        $cw('R2 Come Home', 2, 21, 'skip', 'R2-D2 must rescue Anakin and Mace Windu after Boba Fett\'s trap leaves them buried in rubble.');
        $cw('Lethal Trackdown', 2, 22, 'skip', 'Plo Koon and Ahsoka track down Boba Fett and his crew of bounty hunters to rescue their hostages.');
        $cw('Corruption', 3, 5, 'recommended', 'Padme visits Satine on Mandalore and uncovers a black market corruption scheme involving poisoned tea.');
        $cw('The Academy', 3, 6, 'recommended', 'Ahsoka teaches at the Royal Academy on Mandalore and helps students expose a corruption conspiracy.');
        $cw('Assassin', 3, 7, 'recommended', 'Ahsoka is plagued by visions of assassin Aurra Sing targeting Padme.');
        $cw('ARC Troopers', 3, 2, 'must', 'Grievous and Ventress lead an assault on Kamino to destroy the clone production facilities.');
        $cw('Sphere of Influence', 3, 4, 'skip', 'Ahsoka helps a Pantoran senator rescue his kidnapped daughters from Trade Federation custody.');
        $cw('Evil Plans', 3, 8, 'skip', 'C-3PO and R2-D2 are captured by Cad Bane in the Coruscant marketplace.');
        $cw('Hostage Crisis', 1, 22, 'recommended', 'Cad Bane seizes the Senate building and takes hostages to free Ziro the Hutt.');
        $cw('Hunt for Ziro', 3, 9, 'recommended', 'Obi-Wan and Quinlan Vos pursue Cad Bane and the escaped Ziro the Hutt across the galaxy.');
        $cw('Heroes on Both Sides', 3, 10, 'must', 'Ahsoka visits the Separatist Senate and discovers that ordinary people on both sides want peace.');
        $cw('Pursuit of Peace', 3, 11, 'recommended', 'Padme fights to pass a peace treaty while bounty hunters try to silence her.');
        $cw('Senate Murders', 2, 15, 'recommended', 'Padme investigates the murder of a senator who opposed a military spending bill.');
        $cw('Nightsisters', 3, 12, 'must', 'Ventress survives Dooku\'s betrayal and returns to her homeworld of Dathomir to plot revenge with the Nightsisters.');
        $cw('Monster', 3, 13, 'must', 'The Nightsisters select a new assassin for Dooku, the fearsome Savage Opress.');
        $cw('Witches of the Mist', 3, 14, 'must', 'Savage Opress turns on Dooku and Ventress, setting out to find his long-lost brother Darth Maul.');
        $cw('Overlords', 3, 15, 'must', 'Anakin, Obi-Wan, and Ahsoka are drawn to a mysterious planet ruled by three immortal Force wielders.');
        $cw('Altar of Mortis', 3, 16, 'must', 'On Mortis, the Son turns Ahsoka to the dark side and reveals a prophecy about Anakin\'s true destiny.');
        $cw('Ghosts of Mortis', 3, 17, 'must', 'Anakin is shown his dark future by the Son and must choose whether to destroy him at terrible cost.');
        $cw('The Citadel', 3, 18, 'must', 'Anakin leads a team including a young Captain Tarkin into an impenetrable Separatist prison to rescue Jedi.');
        $cw('Counter Attack', 3, 19, 'must', 'The rescue mission goes wrong and the team must fight their way out of the Citadel with dwindling resources.');
        $cw('Citadel Rescue', 3, 20, 'must', 'With casualties mounting, Anakin and Ahsoka make a desperate final push to escape the Citadel.');
        $cw('Padawan Lost', 3, 21, 'must', 'Ahsoka is captured by Trandoshan hunters and stranded on a moon as prey.');
        $cw('Wookiee Hunt', 3, 22, 'must', 'Ahsoka joins forces with a young Chewbacca to lead the surviving captives against their Trandoshan hunters.');
        $cw('Water War', 4, 1, 'skip', 'The Mon Calamari and Quarren go to war over their ocean planet\'s throne.');
        $cw('Gungan Attack', 4, 2, 'skip', 'With Republic forces overwhelmed, Jar Jar leads a Gungan army into the underwater battle.');
        $cw('Prisoners', 4, 3, 'skip', 'Anakin, Ahsoka, and the Mon Calamari king are captured and held prisoner in the depths of the ocean.');
        $cw('Shadow Warrior', 4, 4, 'skip', 'Jar Jar impersonates Boss Lyonie to prevent a Gungan attack on Naboo, while Anakin captures Grievous.');
        $cw('Mercy Mission', 4, 5, 'skip', 'R2-D2 and C-3PO help the inhabitants of a damaged planet restore their world\'s equilibrium.');
        $cw('Nomad Droids', 4, 6, 'skip', 'R2 and C-3PO crash-land on a series of strange planets in a Wizard of Oz style adventure.');
        $cw('Darkness on Umbara', 4, 7, 'must', 'The 501st Legion is placed under a cruel new Jedi General on the dark, hostile planet of Umbara.');
        $cw('The General', 4, 8, 'must', 'General Krell sends the clones on a suicide mission. Rex begins to question his orders.');
        $cw('Plan of Dissent', 4, 9, 'must', 'Rex\'s men disobey Krell\'s suicidal orders and launch an unauthorized strike that succeeds at a cost.');
        $cw('Carnage of Krell', 4, 10, 'must', 'The truth about General Krell is revealed in a shocking and brutal confrontation with Rex and the 501st.');
        $cw('Kidnapped', 4, 11, 'must', 'Zygerrian slavers raid a peaceful planet and capture its population including Togrutan colonists.');
        $cw('Slaves of the Republic', 4, 12, 'must', 'Anakin, Obi-Wan and Ahsoka go undercover in the Zygerrian slave empire to rescue the colonists.');
        $cw('Escape from Kadavo', 4, 13, 'must', 'Anakin must escape the slave processing facility while Obi-Wan endures brutal treatment to protect the prisoners.');
        $cw('A Friend In Need', 4, 14, 'recommended', 'Ahsoka helps Lux Bonteri escape Death Watch and begins to understand both his idealism and its dangers.');
        $cw('Deception', 4, 15, 'must', 'Obi-Wan fakes his death and goes undercover as a criminal to infiltrate a plot to assassinate Chancellor Palpatine.');
        $cw('Friends and Enemies', 4, 16, 'must', 'Obi-Wan, disguised as bounty hunter Rako Hardeen, is hunted by Anakin who doesn\'t know his master is alive.');
        $cw('The Box', 4, 17, 'must', 'Obi-Wan competes in a deadly tournament of bounty hunters inside a lethal cube designed by Moralo Eval.');
        $cw('Crisis on Naboo', 4, 18, 'must', 'The assassination plot against Palpatine reaches its climax on Naboo with Obi-Wan\'s cover near-broken.');
        $cw('Massacre', 4, 19, 'must', 'Dooku sends Grievous to wipe out the Nightsisters of Dathomir in revenge for Ventress.');
        $cw('Bounty', 4, 20, 'recommended', 'Ventress joins a crew of bounty hunters including a young Boba Fett on a dangerous protection job.');
        $cw('Brothers', 4, 21, 'must', 'Savage Opress searches the galaxy\'s underworld and finally finds his brother, a broken feral Darth Maul.');
        $cw('Revenge', 4, 22, 'must', 'Maul restored to sanity sets his sights on Obi-Wan Kenobi with devastating consequences.');
        $cw('A War on Two Fronts', 5, 2, 'must', 'Anakin, Obi-Wan, Ahsoka and Rex train a group of rebels to fight the Separatists on Onderon.');
        $cw('Front Runners', 5, 3, 'must', 'The Onderon rebels begin their guerrilla campaign against the Separatist-backed king.');
        $cw('The Soft War', 5, 4, 'must', 'The rebellion grows but the Separatists tighten their grip, forcing a desperate rescue of the true king.');
        $cw('Tipping Points', 5, 5, 'must', 'The Onderon rebellion reaches its climax with a battle that costs the rebels their greatest leader.');
        $cw('The Gathering', 5, 6, 'recommended', 'Ahsoka escorts younglings to Ilum where each must find their kyber crystal to build their first lightsaber.');
        $cw('A Test of Strength', 5, 7, 'recommended', 'Hondo\'s pirates attack the ship carrying Ahsoka and the younglings who must use their unfinished lightsabers.');
        $cw('Bound for Rescue', 5, 8, 'recommended', 'The younglings disguise themselves as a circus troupe to sneak into Hondo\'s compound and rescue Ahsoka.');
        $cw('A Necessary Bond', 5, 9, 'recommended', 'Ahsoka and the younglings must team up with Hondo against a Separatist attack on his base.');
        $cw('Secret Weapons', 5, 10, 'skip', 'R2-D2 leads a squad of astromech droids on a covert mission to steal a Separatist encryption module.');
        $cw('A Sunny Day in the Void', 5, 11, 'skip', 'R2 and the astromechs crash-land on a featureless void planet with no landmarks or navigation.');
        $cw('Missing in Action', 5, 12, 'recommended', 'R2 discovers a clone trooper living as an amnesiac in a Separatist-occupied town and helps him remember who he is.');
        $cw('Point of No Return', 5, 13, 'skip', 'R2 and the droids must stop a bomb-laden ship from destroying a crucial Republic conference.');
        $cw('Revival', 5, 1, 'must', 'Maul and Savage Opress terrorize the galaxy, forcing Obi-Wan and Adi Gallia to confront them.');
        $cw('Eminence', 5, 14, 'must', 'Maul forges an alliance with Death Watch and the criminal underworld to build a shadow army.');
        $cw('Shades of Reason', 5, 15, 'must', 'Maul\'s criminal alliance launches its takeover of Mandalore. Pre Vizsla pays the price for his deal with Maul.');
        $cw('The Lawless', 5, 16, 'must', 'Maul lures Obi-Wan to Mandalore and kills Duchess Satine. Darth Sidious arrives to deal with his former apprentice personally.');
        $cw('Sabotage', 5, 17, 'must', 'Anakin and Ahsoka investigate a bombing at the Jedi Temple, a mystery that cuts close to home.');
        $cw('The Jedi Who Knew Too Much', 5, 18, 'must', 'Ahsoka is framed for the Temple bombing and must flee Republic forces to prove her innocence.');
        $cw('To Catch a Jedi', 5, 19, 'must', 'Ahsoka hides in the Coruscant underworld as Anakin desperately searches for the real bomber.');
        $cw('The Wrong Jedi', 5, 20, 'must', 'Ahsoka stands trial before the Senate. Even if acquitted, nothing will be the same. She makes a decision that breaks Anakin\'s heart.');
        $cw('The Unknown', 6, 1, 'must', 'A clone trooper suddenly executes a Jedi General, the first hint that something is buried deep in every clone\'s mind.');
        $cw('Conspiracy', 6, 2, 'must', 'Fives investigates the clone\'s behaviour and uncovers a buried inhibitor chip in every clone\'s brain.');
        $cw('Fugitive', 6, 3, 'must', 'Fives goes rogue to expose the inhibitor chip conspiracy, getting closer to the truth than anyone should.');
        $cw('Orders', 6, 4, 'must', 'Fives confronts Palpatine himself with the truth about Order 66 and pays the ultimate price.');
        $cw('An Old Friend', 6, 5, 'recommended', 'Padme encounters an old flame now working for the Banking Clan and uncovers a scheme to fund both sides of the war.');
        $cw('The Rise of Clovis', 6, 6, 'recommended', 'Clovis rises to lead the Banking Clan while Anakin\'s jealousy dangerously escalates.');
        $cw('Crisis at the Heart', 6, 7, 'recommended', 'Dooku manipulates Clovis into causing a galactic financial crisis, allowing Palpatine to seize control of the banks.');
        $cw('The Disappeared', 6, 8, 'recommended', 'Mace Windu and Jar Jar investigate the disappearance of Dagoyan Masters on a spiritual planet.');
        $cw('The Disappeared Part II', 6, 9, 'recommended', 'Mace and Jar Jar race to rescue Queen Julia from a cult of the dark side before a sacrificial ritual.');
        $cw('The Lost One', 6, 10, 'must', 'A recovered lightsaber leads the Jedi to uncover what really happened to Master Sifo-Dyas and who ordered the clone army.');
        $cw('Voices', 6, 11, 'must', 'Yoda hears the voice of the dead Qui-Gon Jinn and sets out on a journey to discover how consciousness survives death.');
        $cw('Destiny', 6, 12, 'must', 'Yoda travels to the mysterious wellspring of the Force and confronts manifestations of the dark side.');
        $cw('Sacrifice', 6, 13, 'must', 'Yoda faces a vision of Darth Sidious on Moraband and glimpses the terrible future, but also a hope for beyond death.');
        $cw('Gone with a Trace', 7, 5, 'must', 'Ahsoka, living without the Force Order, befriends two sisters in the Coruscant underworld.');
        $cw('Deal No Deal', 7, 6, 'must', 'Ahsoka and the sisters get entangled in a spice-running job that attracts the Pyke Syndicate.');
        $cw('Dangerous Debt', 7, 7, 'must', 'Captured by the Pykes, Ahsoka and the sisters must survive imprisonment while her identity stays hidden.');
        $cw('Together Again', 7, 8, 'must', 'Ahsoka negotiates a deal for their freedom, revealing her identity and reconnecting with her past.');
        $cw('The Bad Batch', 7, 1, 'must', 'Rex teams up with a squad of elite, genetically mutated clones, Clone Force 99, on a dangerous mission.');
        $cw('A Distant Echo', 7, 2, 'must', 'Rex believes a clone thought dead, Echo, is still alive and being used as a Separatist algorithm.');
        $cw('On the Wings of Keeradaks', 7, 3, 'must', 'The Bad Batch and Anakin rescue Echo and escape a Separatist facility on the back of flying creatures.');
        $cw('Unfinished Business', 7, 4, 'must', 'Echo uses his Separatist knowledge to turn the tide of battle, and must decide where he truly belongs.');

        // Revenge of the Sith
        $add(['title' => 'Revenge of the Sith', 'type' => 'film', 'series_name' => null, 'season' => null, 'episode' => null, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '19 BBY', 'duration_minutes' => 140, 'recommendation' => 'must', 'thumbnail_color' => '#3a1a1a', 'synopsis' => 'The Clone Wars end as Anakin Skywalker falls to the dark side, the Jedi are destroyed, and the Galactic Empire rises from the ashes.']);

        // Siege of Mandalore concurrent with ROTS
        $cw('Old Friends Not Forgotten', 7, 9, 'must', 'Ahsoka reunites with Anakin and Obi-Wan briefly before launching the Siege of Mandalore alongside Rex as Order 66 approaches.');
        $cw('The Phantom Apprentice', 7, 10, 'must', 'Ahsoka corners Maul on Mandalore. His warnings about Anakin\'s fate are chilling and she doesn\'t believe him.');
        $cw('Shattered', 7, 11, 'must', 'Order 66 is executed. Rex fights his own programming as Ahsoka faces her brothers turning against her.');
        $cw('Victory and Death', 7, 12, 'must', 'The galaxy has fallen. Ahsoka and Rex survive, but at a cost that will haunt them forever.');

        // Tales of the Jedi episodes 5-6
        $add(['title' => 'Practice Makes Perfect', 'type' => 'series', 'series_name' => 'Tales of the Jedi', 'season' => 1, 'episode' => 5, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '19 BBY', 'duration_minutes' => 14, 'recommendation' => 'must', 'thumbnail_color' => '#2a2a1a', 'synopsis' => 'Anakin trains Ahsoka in a unique survival exercise, a scene that pays off heartbreakingly during Order 66.']);
        $add(['title' => 'Resolve', 'type' => 'series', 'series_name' => 'Tales of the Jedi', 'season' => 1, 'episode' => 6, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '19 BBY', 'duration_minutes' => 14, 'recommendation' => 'must', 'thumbnail_color' => '#2a2a1a', 'synopsis' => 'Ahsoka survives Order 66 and goes into hiding, a poignant epilogue to her Clone Wars arc.']);

        // ── THE BAD BATCH ─────────────────────────────────────────────────
        $bb = function (string $title, int $season, int $ep, string $synopsis = '') use (&$add) {
            $add(['title' => $title, 'type' => 'series', 'series_name' => 'The Bad Batch', 'season' => $season, 'episode' => $ep, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '19 BBY', 'duration_minutes' => 30, 'recommendation' => 'must', 'thumbnail_color' => '#1a3a2a', 'synopsis' => $synopsis]);
        };

        // Season 1
        $bb('Aftermath', 1, 1, 'Clone Force 99 witnesses the execution of Order 66 and must decide whether to serve the new Empire or go rogue.');
        $bb('Cut and Run', 1, 2, 'The Batch visits an old contact, a deserter clone living with a family, and must help them escape Imperial registration.');
        $bb('Replacements', 1, 3, 'The Batch gets stranded on a desolate moon while the Empire begins replacing clones with recruited stormtroopers.');
        $bb('Cornered', 1, 4, 'A supply run goes awry when the Batch is recognized and hunted by Imperial forces on a populated planet.');
        $bb('Rampage', 1, 5, 'The Batch strikes a deal to take on a mission involving a rancor, their first job for the informant Cid.');
        $bb('Decommissioned', 1, 6, 'On a mission to acquire a valuable tactical droid, the Batch encounters smugglers after the same target.');
        $bb('Battle Scars', 1, 7, 'Rex warns the Batch about their inhibitor chips and they must find a way to remove them before it is too late.');
        $bb('Reunion', 1, 8, 'The Batch find themselves cornered on treacherous terrain as Crosshair leads Imperial forces against them.');
        $bb('Bounty Lost', 1, 9, 'Omega is captured and the Batch must mount a desperate rescue mission to get her back.');
        $bb('Common Ground', 1, 10, 'The Batch has their ideology challenged when tasked with helping a Separatist senator resist Imperial occupation.');
        $bb('Devil\'s Deal', 1, 11, 'As the seeds of rebellion foment on Ryloth, the Empire schemes to make an example of the planet.');
        $bb('Rescue on Ryloth', 1, 12, 'The Batch is tasked with a dangerous mission to rescue Hera Syndulla\'s family from Imperial captivity.');
        $bb('Infested', 1, 13, 'To save Cid\'s operation, the Batch must sabotage a gangster\'s base in a creature-infested mine.');
        $bb('War-Mantle', 1, 14, 'After receiving a distress call, the Batch tracks it to a secret Imperial facility hiding a disturbing truth about clone soldiers.');
        $bb('Return to Kamino', 1, 15, 'The Batch returns to Kamino to rescue Crosshair, walking into a trap as the Empire arrives to destroy Tipoca City.');
        $bb('Kamino Lost', 1, 16, 'As Tipoca City falls beneath the ocean, the Bad Batch must figure out how to survive and reckon with Crosshair\'s choices.');

        // Season 2
        $bb('Spoils of War', 2, 1, 'The Bad Batch raids an Imperial war chest, but the mission becomes complicated by unexpected arrivals.');
        $bb('Ruins of War', 2, 2, 'Separated and scattered, the Batch must regroup while navigating the aftermath of their chaotic raid.');
        $bb('The Solitary Clone', 2, 3, 'Crosshair is sent on a mission with a fellow Imperial commander and begins to question his allegiance to the Empire.');
        $bb('Entombed', 2, 4, 'The Batch explores an ancient Separatist vault, uncovering technology that attracts dangerous attention.');
        $bb('Faster', 2, 5, 'Omega and the Batch get caught up in dangerous racing circuits while searching for credits to survive.');
        $bb('Tribe', 2, 6, 'The Batch encounters a community protecting a Force-sensitive child, echoing Grogu\'s story from The Mandalorian.');
        $bb('The Clone Conspiracy', 2, 7, 'A clone senator begins investigating the truth behind the inhibitor chip program, putting himself in Imperial crosshairs.');
        $bb('Truth and Consequences', 2, 8, 'The Batch assists in an effort to expose the Empire\'s cloning secrets before evidence is permanently buried.');
        $bb('The Crossing', 2, 9, 'Stranded in a desert wasteland, the Batch must survive while Tech faces a critical test of his limits.');
        $bb('Retrieval', 2, 10, 'Omega leads a desperate effort to recover the Batch\'s ship with an unlikely group of local allies.');
        $bb('Metamorphosis', 2, 11, 'The Batch investigates a crashed Imperial transport carrying a strange and dangerous creature.');
        $bb('The Outpost', 2, 12, 'Crosshair is sent to a remote Imperial outpost and begins to understand what the Empire truly thinks of its clone soldiers.');
        $bb('Pabu', 2, 13, 'The Batch discovers a peaceful island community, giving Omega a glimpse of what a normal life could look like.');
        $bb('Tipping Point', 2, 14, 'The Batch learns of a new Imperial threat involving cloning experimentation that puts everything at risk.');
        $bb('The Summit', 2, 15, 'The Batch infiltrates an Imperial strategy summit to gather intelligence on the Empire\'s expanding clone program.');
        $bb('Plan 99', 2, 16, 'The season finale. A devastating mission goes wrong, forcing the Batch to make an impossible sacrifice.');

        // Season 3
        $bb('Confined', 3, 1, 'Imprisoned on Tantiss, Omega adjusts to a new life inside the Empire\'s most secret cloning facility.');
        $bb('Paths Unknown', 3, 2, 'Following a lead, Hunter and Wrecker make a startling discovery about what the Empire has been doing with clones.');
        $bb('Shadows of Tantiss', 3, 3, 'Omega and Crosshair hatch a daring plan to escape Mount Tantiss from within.');
        $bb('A Different Approach', 3, 4, 'Stranded in dangerous territory, Omega and Crosshair must work together to survive and find help.');
        $bb('The Return', 3, 5, 'Tensions rise as the reunited Batch navigates new dynamics on a dangerous mission.');
        $bb('Infiltration', 3, 6, 'The Batch reunites with an ally in need, uncovering more of the Empire\'s cloning conspiracy.');
        $bb('Extraction', 3, 7, 'As enemies close in, the Batch must evacuate a critical stronghold under heavy fire.');
        $bb('Bad Territory', 3, 8, 'Desperate for intel, Hunter and Wrecker track down a dangerous bounty hunter, Fennec Shand.');
        $bb('The Harbinger', 3, 9, 'As the Batch plans their next move, a mysterious stranger arrives with unexpected ties to their past.');
        $bb('Identity Crisis', 3, 10, 'Emerie confronts the dark secrets behind Hemlock\'s scientific research on Tantiss.');
        $bb('Point of No Return', 3, 11, 'The Empire closes in on the Batch as the stakes of their mission reach a critical point.');
        $bb('Juggernaut', 3, 12, 'While seeking an unexpected source of help, the Batch must make a daring escape from Imperial forces.');
        $bb('Into the Breach', 3, 13, 'The Batch preps for a final gambit deep in enemy territory. The assault on Mount Tantiss begins.');
        $bb('Flash Strike', 3, 14, 'Odds are against the Batch as they operate behind enemy lines inside the Empire\'s most fortified facility.');
        $bb('The Cavalry Has Arrived', 3, 15, 'Omega and the Batch battle Imperial forces for their freedom in the epic series finale.');

        // Tales of the Underworld episodes 1-3
        $add(['title' => 'Lando', 'type' => 'series', 'series_name' => 'Tales of the Underworld', 'season' => 1, 'episode' => 1, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '19 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#1a1a2a', 'synopsis' => 'An anthology story featuring Lando Calrissian set in the early days of the Empire.']);
        $add(['title' => 'General Grievous', 'type' => 'series', 'series_name' => 'Tales of the Underworld', 'season' => 1, 'episode' => 2, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '19 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#1a1a2a', 'synopsis' => 'An anthology story exploring General Grievous in the final days of the Clone Wars.']);
        $add(['title' => 'Count Dooku', 'type' => 'series', 'series_name' => 'Tales of the Underworld', 'season' => 1, 'episode' => 3, 'era' => 'republic', 'era_label' => 'Republic Era', 'timeline' => '19 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#1a1a2a', 'synopsis' => 'An anthology story exploring Count Dooku\'s perspective in the final days of the Republic.']);

        // ══════════════════════════════════════════════════════════════════
        // EMPIRE ERA
        // ══════════════════════════════════════════════════════════════════

        // Tales of the Empire episodes 1-2
        $add(['title' => 'The Path of Fear', 'type' => 'series', 'series_name' => 'Tales of the Empire', 'season' => 1, 'episode' => 1, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '18 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#2a1a1a', 'synopsis' => 'Morgan Elsbeth witnesses the destruction of her people. The origin of a villain introduced in The Mandalorian.']);
        $add(['title' => 'The Path of Anger', 'type' => 'series', 'series_name' => 'Tales of the Empire', 'season' => 1, 'episode' => 2, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '18 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#2a1a1a', 'synopsis' => 'A former Jedi falls to the dark side and becomes an Inquisitor, showing the process of corruption under the Empire.']);

        // Tales of the Empire episodes 4-6
        $add(['title' => 'The Path of Hate', 'type' => 'series', 'series_name' => 'Tales of the Empire', 'season' => 1, 'episode' => 4, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '4 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#2a1a1a', 'synopsis' => 'Barriss Offee, imprisoned for years, is offered a chance at freedom at a terrible price.']);
        $add(['title' => 'The Path of Purge', 'type' => 'series', 'series_name' => 'Tales of the Empire', 'season' => 1, 'episode' => 5, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '4 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#2a1a1a', 'synopsis' => 'An Inquisitor hunts a surviving Jedi but begins to question the path she has chosen.']);
        $add(['title' => 'The Path of Redemption', 'type' => 'series', 'series_name' => 'Tales of the Empire', 'season' => 1, 'episode' => 6, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '4 BBY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#2a1a1a', 'synopsis' => 'The final anthology short. A story of choices, consequences, and the possibility of redemption under the Empire.']);

        // ── REBELS ────────────────────────────────────────────────────────
        $reb = function (string $title, int $season, int $ep, string $synopsis = '') use (&$add) {
            $add(['title' => $title, 'type' => 'series', 'series_name' => 'Star Wars Rebels', 'season' => $season, 'episode' => $ep, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '5 BBY', 'duration_minutes' => 22, 'recommendation' => 'must', 'thumbnail_color' => '#3a2a1a', 'synopsis' => $synopsis]);
        };

        // Season 1
        $reb('Spark of Rebellion', 1, 1, 'Street thief Ezra Bridger encounters the crew of the Ghost and joins their fight against the Empire on Lothal.');
        $reb('Droids in Distress', 1, 2, 'The Ghost crew steal a shipment of weapons and encounter a familiar droid duo in the process.');
        $reb('Fighter Flight', 1, 3, 'Ezra and Zeb accidentally steal a TIE fighter on a supply run, drawing Imperial attention to the crew.');
        $reb('Rise of the Old Masters', 1, 4, 'Kanan tries to train Ezra but struggles as news arrives that a Jedi Master is alive in Imperial custody.');
        $reb('Breaking Ranks', 1, 5, 'Ezra goes undercover as an Imperial Academy cadet to steal a decoder and expose Imperial plans.');
        $reb('Out of Darkness', 1, 6, 'Hera and Sabine are stranded and discover they are not alone in a seemingly abandoned supply depot.');
        $reb('Empire Day', 1, 7, 'While disrupting Empire Day festivities, the crew learns a refugee has critical information for the rebellion.');
        $reb('Gathering Forces', 1, 8, 'Kanan and Ezra protect an Imperial defector while Ezra confronts a darkness within himself.');
        $reb('Path of the Jedi', 1, 9, 'Ezra must face a great challenge inside a Jedi Temple as part of his growth as a Padawan.');
        $reb('Idiot\'s Array', 1, 10, 'Zeb bets and loses Chopper to smuggler Lando Calrissian, forcing the crew into transporting unusual cargo.');
        $reb('Vision of Hope', 1, 11, 'Ezra has a fragmented vision of meeting exiled senator Gall Trayvis, who broadcasts anti-Imperial messages.');
        $reb('Call to Action', 1, 12, 'Grand Moff Tarkin visits Lothal to deal with the rebels and captures Kanan Jarrus.');
        $reb('Rebel Resolve', 1, 13, 'After failing to find where Kanan is detained, the crew launches a desperate plan to rescue him.');
        $reb('Fire Across the Galaxy', 1, 14, 'The crew seizes an Imperial transport to rescue Kanan and encounters a new ally: Ahsoka Tano.');

        // Season 2
        $reb('The Siege of Lothal', 2, 1, 'Darth Vader himself arrives to crush the rebellion on Lothal, revealing how outmatched they truly are.');
        $reb('The Lost Commanders', 2, 2, 'Ahsoka sends the Ghost crew to Seelos to find an old friend, a legendary clone commander.');
        $reb('Relics of the Old Republic', 2, 3, 'The Empire tracks the rebels to Seelos. Rex must decide whether to join the growing rebellion.');
        $reb('Always Two There Are', 2, 4, 'Zeb, Sabine, and Ezra discover that there are more Inquisitors hunting Jedi than they knew.');
        $reb('Brothers of the Broken Horn', 2, 5, 'Ezra receives a distress signal from pirate Hondo Ohnaka\'s ship and investigates alone.');
        $reb('Wings of the Master', 2, 6, 'Hera seeks out a master engineer who has built a powerful new starfighter prototype for the rebellion.');
        $reb('Blood Sisters', 2, 7, 'Sabine encounters someone from her past, a bounty hunter named Ketsu, who may be friend or foe.');
        $reb('Stealth Strike', 2, 8, 'A new Imperial weapon captures Ezra and Commander Sato. Rex and Kanan must put differences aside to save them.');
        $reb('The Future of the Force', 2, 9, 'After the Inquisitors begin targeting Force-sensitive babies, Ahsoka and the Ghost crew investigate.');
        $reb('Legacy', 2, 10, 'After seeing his parents in a vision, Ezra believes they may still be alive and heads back to Lothal.');
        $reb('A Princess on Lothal', 2, 11, 'A young Princess Leia arrives with ships for the rebellion and Imperial complications follow.');
        $reb('The Protector of Concord Dawn', 2, 12, 'The rebels look for a new safe route through Mandalorian space and encounter Fenn Rau\'s Protectors.');
        $reb('Legends of the Lasat', 2, 13, 'Following a tip from Hondo, the Ghost crew rescues a pair of Lasats, including one of Zeb\'s surviving people.');
        $reb('The Call', 2, 14, 'The crew is on a mission to capture a fuel shipment from the Mining Guild and encounters mysterious creatures.');
        $reb('Homecoming', 2, 15, 'To shelter their fighters, the rebels plan to capture an Imperial carrier with help from Hera\'s estranged father.');
        $reb('The Honorable Ones', 2, 16, 'Zeb and Agent Kallus are stranded together, an unlikely pairing that forces both to reconsider their assumptions.');
        $reb('Shroud of Darkness', 2, 17, 'Ezra and Kanan visit a Jedi Temple where they receive unsettling visions and Ahsoka faces a shocking truth.');
        $reb('The Forgotten Droid', 2, 18, 'Chopper steals a replacement strut and befriends an Imperial inventory droid with useful knowledge.');
        $reb('The Mystery of Chopper Base', 2, 19, 'After finding a safe planet, the rebels discover creatures that make it far less safe.');
        $reb('Twilight of the Apprentice', 2, 20, 'Ahsoka, Ezra, Kanan and Chopper arrive on Malachor, a Sith world. A devastating confrontation awaits.');

        // Season 3
        $reb('Steps Into Shadow', 3, 1, 'Six months later, Ezra leads a mission using a Sith holocron. Kanan must confront how far his apprentice has strayed.');
        $reb('The Holocrons of Fate', 3, 2, 'Maul kidnaps the Ghost crew and forces Ezra and Kanan to merge a Sith and Jedi holocron to reveal a secret.');
        $reb('The Antilles Extraction', 3, 3, 'Sabine goes undercover at an Imperial Academy to extract rebel-sympathizing pilots including a young Wedge Antilles.');
        $reb('Hera\'s Heroes', 3, 4, 'The Ghost crew makes a supply run to Ryloth but Hera is pushed into direct conflict with Grand Admiral Thrawn.');
        $reb('The Last Battle', 3, 5, 'A surviving Clone Wars-era droid commander challenges Rex to settle whether the Republic or Separatists were superior.');
        $reb('Imperial Supercommandos', 3, 6, 'Sabine tries to convince Fenn Rau to join the rebellion but Mandalorian Imperial loyalists attack.');
        $reb('Iron Squadron', 3, 7, 'The crew arrives to help evacuate a planet and discovers a stubborn young rebel crew refusing to leave.');
        $reb('The Wynkahthu Job', 3, 8, 'An uneasy alliance with Hondo to raid an abandoned cargo ship turns into a fight for survival.');
        $reb('An Inside Man', 3, 9, 'Ezra and Kanan return to Lothal to scout an Imperial factory and find an unexpected agent within.');
        $reb('Visions and Voices', 3, 10, 'Ezra is plagued by visions of Maul and must perform a ritual that reveals a disturbing destiny.');
        $reb('Ghosts of Geonosis Part 1', 3, 11, 'Saw Gerrera and his squad have gone missing on Geonosis. The rebels investigate what the Empire built there.');
        $reb('Ghosts of Geonosis Part 2', 3, 12, 'The crew continues the rescue mission and discovers the Empire\'s devastating secret on Geonosis.');
        $reb('Warhead', 3, 13, 'While the Ghost crew is away, an Imperial infiltration droid attacks the rebel base. Zeb must stop it alone.');
        $reb('Trials of the Darksaber', 3, 14, 'Sabine must learn to wield the Darksaber, a weapon with vast political significance for Mandalore.');
        $reb('Legacy of Mandalore', 3, 15, 'Sabine returns to her family on Krownest with the Darksaber, hoping to unite Mandalorians against the Empire.');
        $reb('Through Imperial Eyes', 3, 16, 'Told from Agent Kallus\'s perspective as Thrawn closes in on the rebel spy known as Fulcrum.');
        $reb('Secret Cargo', 3, 17, 'The crew escorts a VIP rebel courier and witnesses the birth of the Rebellion\'s public declaration of intent.');
        $reb('Double Agent Droid', 3, 18, 'Chopper is hijacked by Imperial forces and used as a spy. AP-5 and Wedge must stop him.');
        $reb('Twin Suns', 3, 19, 'Ezra follows Maul to Tatooine on a search for Obi-Wan Kenobi, ending a rivalry that began long ago.');
        $reb('Zero Hour Part 1', 3, 20, 'Thrawn discovers the rebel base on Atollon and launches a devastating assault, the rebellion\'s darkest hour.');
        $reb('Zero Hour Part 2', 3, 21, 'The battle of Atollon reaches its desperate conclusion as the rebels fight for survival against Thrawn.');

        // Season 4
        $reb('Heroes of Mandalore Part 1', 4, 1, 'Sabine leads the rescue of her father from the Empire and uncovers a weapon of devastating potential.');
        $reb('Heroes of Mandalore Part 2', 4, 2, 'Sabine must decide whether to destroy or use a deadly weapon that could liberate or destroy Mandalore.');
        $reb('In the Name of the Rebellion Part 1', 4, 3, 'The Ghost crew is sent to spy on an Imperial outpost where they encounter Saw Gerrera\'s extremist methods.');
        $reb('In the Name of the Rebellion Part 2', 4, 4, 'Ezra and Sabine join Saw Gerrera on a mission that forces them to question how far rebellion can go.');
        $reb('The Occupation', 4, 5, 'The rebels return to Lothal to face a new Imperial threat and find their home world drastically changed.');
        $reb('Flight of the Defender', 4, 6, 'The Ghost crew scouts an Imperial airfield where Thrawn\'s deadliest TIE fighter prototype is being tested.');
        $reb('Kindred', 4, 7, 'Ezra, Jai Kell and Zeb secure the TIE Defender\'s hyperdrive while Loth-wolves guide Ezra toward his destiny.');
        $reb('Crawler Commandeers', 4, 8, 'After taking shelter, the rebels commandeer a mining crawler to communicate with the wider rebellion.');
        $reb('Rebel Assault', 4, 9, 'Hera leads an assault on Lothal against orders and the battle turns catastrophic.');
        $reb('Jedi Night', 4, 10, 'While Hera is being tortured by Governor Pryce, Ezra, Kanan and Sabine prepare a daring rescue. A Jedi will not survive this night.');
        $reb('DUME', 4, 11, 'Reeling from devastating loss, the surviving rebels must find the will to continue guided by Loth-wolves and the Force.');
        $reb('Wolves and a Door', 4, 12, 'With the aid of the Loth-Wolves, the crew infiltrates an Imperial facility at the ruins of the Jedi Temple on Lothal.');
        $reb('A World Between Worlds', 4, 13, 'Ezra enters a mystical dimension that exists between all time and space and must choose what to change.');
        $reb('A Fool\'s Hope', 4, 14, 'Hera, Rex, and Kallus recruit an unlikely crew for a plan to liberate Lothal once and for all.');
        $reb('Family Reunion and Farewell Part 1', 4, 15, 'With Pryce as their prisoner, the rebels force her to give them clearance to enter the Imperial complex on Lothal.');
        $reb('Family Reunion and Farewell Part 2', 4, 16, 'The final battle for Lothal and a sacrifice that echoes across the galaxy. Watch the last 3 minutes AFTER Return of the Jedi.');

        // Films
        $add(['title' => 'Rogue One', 'type' => 'film', 'series_name' => null, 'season' => null, 'episode' => null, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '0 BBY', 'duration_minutes' => 133, 'recommendation' => 'must', 'thumbnail_color' => '#1a2a3a', 'synopsis' => 'A group of rebels risk everything to steal the Death Star plans, a heist story set hours before A New Hope.']);
        $add(['title' => 'A New Hope', 'type' => 'film', 'series_name' => null, 'season' => null, 'episode' => null, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '0 BBY', 'duration_minutes' => 121, 'recommendation' => 'must', 'thumbnail_color' => '#2a1a3a', 'synopsis' => 'Farm boy Luke Skywalker joins the Rebel Alliance and discovers his destiny as the galaxy\'s last hope against the evil Galactic Empire.']);
        $add(['title' => 'The Empire Strikes Back', 'type' => 'film', 'series_name' => null, 'season' => null, 'episode' => null, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '3 ABY', 'duration_minutes' => 124, 'recommendation' => 'must', 'thumbnail_color' => '#0a1a2a', 'synopsis' => 'The Empire hunts the Rebel Alliance as Luke trains with Yoda and discovers a shocking truth about his father.']);
        $add(['title' => 'Return of the Jedi', 'type' => 'film', 'series_name' => null, 'season' => null, 'episode' => null, 'era' => 'empire', 'era_label' => 'Empire Era', 'timeline' => '4 ABY', 'duration_minutes' => 131, 'recommendation' => 'must', 'thumbnail_color' => '#1a3a1a', 'synopsis' => 'Luke confronts Vader and the Emperor while the Rebel Alliance mounts a final assault on the second Death Star. The Skywalker saga ends here if you wish.']);

        // ══════════════════════════════════════════════════════════════════
        // NEW REPUBLIC ERA
        // ══════════════════════════════════════════════════════════════════

        // Mandalorian Season 1
        $mando = function (string $title, int $season, int $ep, int $chapter, int $duration, string $synopsis = '') use (&$add) {
            $add(['title' => "Chapter {$chapter}: {$title}", 'type' => 'series', 'series_name' => 'The Mandalorian', 'season' => $season, 'episode' => $ep, 'era' => 'new-republic', 'era_label' => 'New Republic Era', 'timeline' => '9 ABY', 'duration_minutes' => $duration, 'recommendation' => 'must', 'thumbnail_color' => '#3a2a2a', 'synopsis' => $synopsis]);
        };

        $mando('The Mandalorian', 1, 1, 1, 41, 'A lone Mandalorian bounty hunter takes on a well-paying assignment and discovers a mysterious asset that changes everything.');
        $mando('The Child', 1, 2, 2, 34, 'Target in hand, the Mandalorian must contend with scavengers and begins to question his mission.');
        $mando('The Sin', 1, 3, 3, 39, 'The Mandalorian returns to his client and makes a fateful choice that puts him against the entire bounty hunter guild.');
        $mando('Sanctuary', 1, 4, 4, 43, 'The Mandalorian teams up with an ex-soldier to protect a farming village from raiders while hiding from the guild.');
        $mando('The Gunslinger', 1, 5, 5, 37, 'On a familiar desert planet, the Mandalorian helps a rookie bounty hunter who is in way over his head.');
        $mando('The Prisoner', 1, 6, 6, 45, 'The Mandalorian joins a crew of mercenaries springing a convict from a New Republic prison ship.');
        $mando('The Reckoning', 1, 7, 7, 42, 'An old contact invites the Mandalorian to make peace with his enemies but it is a trap.');
        $mando('Redemption', 1, 8, 8, 50, 'The Mandalorian and his allies come to know their true enemy. Grogu is formally named a foundling and Mando accepts fatherhood.');

        // Tales of the Empire episode 3
        $add(['title' => 'The Path of Vengeance', 'type' => 'series', 'series_name' => 'Tales of the Empire', 'season' => 1, 'episode' => 3, 'era' => 'new-republic', 'era_label' => 'New Republic Era', 'timeline' => '9 ABY', 'duration_minutes' => 14, 'recommendation' => 'recommended', 'thumbnail_color' => '#2a1a1a', 'synopsis' => 'Morgan Elsbeth continues her story in the New Republic era, best watched between Mandalorian seasons.']);

        // Mandalorian Season 2
        $mando('The Marshal', 2, 1, 9, 56, 'The Mandalorian is drawn to Tatooine in search of others of his kind and meets a man wearing Mandalorian armour.');
        $mando('The Passenger', 2, 2, 10, 43, 'The Mandalorian must ferry a passenger with precious cargo on a risky journey through dangerous space.');
        $mando('The Heiress', 2, 3, 11, 37, 'The Mandalorian braves the high seas of Trask and meets real Mandalorians led by Bo-Katan Kryze.');
        $mando('The Siege', 2, 4, 12, 39, 'The Mandalorian rejoins old allies on Nevarro for a new mission and disturbing Imperial secrets are uncovered.');
        $mando('The Jedi', 2, 5, 13, 47, 'The Mandalorian journeys to a world ruled by a cruel magistrate and finds Ahsoka Tano, who names the Child: Grogu.');
        $mando('The Tragedy', 2, 6, 14, 34, 'The Mandalorian and the Child continue their journey and Boba Fett returns to reclaim his armour.');
        $mando('The Believer', 2, 7, 15, 37, 'The Mandalorian needs the help of an old enemy to track Grogu\'s location inside the Imperial remnant.');
        $mando('The Rescue', 2, 8, 16, 46, 'The Mandalorian and his allies attempt a daring rescue of Grogu and a legendary Jedi answers the call.');

        // Book of Boba Fett episodes 5-7
        $add(['title' => 'Chapter 5: Return of the Mandalorian', 'type' => 'series', 'series_name' => 'The Book of Boba Fett', 'season' => 1, 'episode' => 5, 'era' => 'new-republic', 'era_label' => 'New Republic Era', 'timeline' => '9 ABY', 'duration_minutes' => 49, 'recommendation' => 'must', 'thumbnail_color' => '#2a1a2a', 'synopsis' => 'Din Djarin\'s story continues, effectively Mandalorian Season 2.5. He visits the Armorer, gets a new ship, and reunites with Grogu. Skip episodes 1 to 4 of this show.']);
        $add(['title' => 'Chapter 6: From the Desert Comes a Stranger', 'type' => 'series', 'series_name' => 'The Book of Boba Fett', 'season' => 1, 'episode' => 6, 'era' => 'new-republic', 'era_label' => 'New Republic Era', 'timeline' => '9 ABY', 'duration_minutes' => 48, 'recommendation' => 'must', 'thumbnail_color' => '#2a1a2a', 'synopsis' => 'Luke Skywalker trains Grogu while the Pyke Syndicate\'s threat to Mos Espa grows. Ahsoka visits. Essential Mandalorian continuation.']);
        $add(['title' => 'Chapter 7: In the Name of Honor', 'type' => 'series', 'series_name' => 'The Book of Boba Fett', 'season' => 1, 'episode' => 7, 'era' => 'new-republic', 'era_label' => 'New Republic Era', 'timeline' => '9 ABY', 'duration_minutes' => 57, 'recommendation' => 'must', 'thumbnail_color' => '#2a1a2a', 'synopsis' => 'The battle for Mos Espa reaches its climax. Din Djarin and Grogu reunite in the finale of this essential Mandalorian chapter.']);

        // Mandalorian Season 3
        $mando('The Apostate', 3, 1, 17, 35, 'The Mandalorian begins an important journey, seeking redemption in the Living Waters of Mandalore.');
        $mando('The Mines of Mandalore', 3, 2, 18, 42, 'The Mandalorian and Grogu explore the ruins of the destroyed planet Mandalore.');
        $mando('The Convert', 3, 3, 19, 56, 'On Coruscant, former Imperials find amnesty in the New Republic, a disturbing look at who gets forgiven.');
        $mando('The Foundling', 3, 4, 20, 31, 'Din Djarin returns to the hidden Mandalorian covert while a young foundling goes missing.');
        $mando('The Pirate', 3, 5, 21, 33, 'The people of Nevarro need protection from rampant pirate attacks led by Gorian Shard.');
        $mando('Guns for Hire', 3, 6, 22, 39, 'The Mandalorian visits an opulent world to track down Mandalorian mercenaries serving a duchess.');
        $mando('The Spies', 3, 7, 23, 38, 'Survivors come out of hiding as the Mandalorians unite but an Imperial trap is closing around them.');
        $mando('The Return', 3, 8, 24, 42, 'The Mandalorian and his allies confront Moff Gideon in a final battle for the future of Mandalore.');

        // Ahsoka
        $ahsoka = function (string $title, int $ep, int $duration, string $synopsis = '') use (&$add) {
            $add(['title' => $title, 'type' => 'series', 'series_name' => 'Ahsoka', 'season' => 1, 'episode' => $ep, 'era' => 'new-republic', 'era_label' => 'New Republic Era', 'timeline' => '9 ABY', 'duration_minutes' => $duration, 'recommendation' => 'must', 'thumbnail_color' => '#1a2a3a', 'synopsis' => $synopsis]);
        };

        $ahsoka('Part One: Master and Apprentice', 1, 55, 'Ahsoka and Professor Huyang search for a map that could lead to Grand Admiral Thrawn and find Sabine Wren holding it.');
        $ahsoka('Part Two: Toil and Trouble', 2, 46, 'Ahsoka and Sabine journey to New Republic shipyards and make an unexpected discovery about Thrawn\'s return.');
        $ahsoka('Part Three: Time to Fly', 3, 39, 'Ahsoka takes Sabine on as her apprentice again while Hera navigates New Republic politics to support their mission.');
        $ahsoka('Part Four: Fallen Jedi', 4, 41, 'Ahsoka and Sabine clash with Baylan Skoll and Shin Hati. Ahsoka falls. Sabine makes a devastating choice.');
        $ahsoka('Part Five: Shadow Warrior', 5, 51, 'Stranded in the World Between Worlds, Ahsoka confronts her past and the ghost of Anakin Skywalker.');
        $ahsoka('Part Six: Far, Far Away', 6, 44, 'Grand Admiral Thrawn and the Great Mothers emerge in a whole other galaxy. The search for Ezra reaches its climax.');
        $ahsoka('Part Seven: Dreams and Madness', 7, 44, 'Ahsoka makes the journey to the far galaxy. Old friends reunite. Thrawn prepares his return to the known galaxy.');
        $ahsoka('Part Eight: The Jedi, the Witch, and the Warlord', 8, 51, 'The first season concludes. Thrawn\'s return to the galaxy looms, and sacrifices are made on both sides.');

        // Insert all
        foreach ($entries as $entry) {
            DB::table('watch_entries')->insert($entry);
        }
    }
}
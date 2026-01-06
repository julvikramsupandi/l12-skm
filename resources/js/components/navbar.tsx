import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Sheet, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from "@/components/ui/sheet";
import { NavigationMenu, NavigationMenuItem, NavigationMenuLink, NavigationMenuList } from "@/components/ui/navigation-menu";
import { Menu } from "lucide-react";
import { Link } from "@inertiajs/react";
import { ThemeToggle } from "./theme-toggle";
import { Separator } from "./ui/separator";

export default function Navbar() {
    const [open, setOpen] = useState(false);

    // 🎯 Daftar menu — hanya didefinisikan sekali
    const menus = [
        { name: "Beranda", href: "/" },
        { name: "Survei", href: "/survey" },
        { name: "Hasil", href: "/tentang" },
        // { name: "Responden", href: "/kontak" },
    ];

    return (
        <header className="bg-violet-700/75 border-b backdrop-blur-md sticky top-0 z-50">
            <div className="container mx-auto flex items-center justify-between px-6 py-3">

                <a href="/">

                    <img
                        src="/assets/images/logo-invers.png"
                        alt="Logo"
                        className="h-10"
                    />
                </a>

                {/* Desktop Menu */}
                <nav className="hidden md:block">
                    <NavigationMenu>
                        <NavigationMenuList className="flex space-x-6">
                            {menus.map((menu) => (
                                <NavigationMenuItem key={menu.href}>
                                    <NavigationMenuLink asChild>
                                        <Link
                                            href={menu.href}
                                            className="text-primary-foreground hover:text-primary-foreground/75"
                                        >
                                            {menu.name}
                                        </Link>
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                            ))}
                        </NavigationMenuList>
                        <NavigationMenuList className="h-4 px-6">
                            <Separator orientation="vertical" />
                        </NavigationMenuList>
                        <NavigationMenuList asChild>
                            <a href={route('login')} className="text-primary-foreground hover:text-primary-foreground/75">
                                Masuk
                            </a>
                        </NavigationMenuList>
                        <NavigationMenuList className="h-4 pl-6 pr-3">
                            <Separator orientation="vertical" />
                        </NavigationMenuList>
                        <NavigationMenuList>
                            <ThemeToggle />
                        </NavigationMenuList>

                    </NavigationMenu>
                </nav>

                {/* Desktop Button */}
                {/* <div className="hidden md:block">
                    <Button variant="default">Masuk</Button>
                </div> */}

                {/* Mobile Menu */}
                <div className="md:hidden">
                    <Sheet open={open} onOpenChange={setOpen}>
                        <SheetTrigger asChild>
                            <Button variant="ghost" size="icon">
                                <Menu className="h-6 w-6 text-primary-foreground" />
                            </Button>
                        </SheetTrigger>

                        <SheetContent side="right" className="w-[250px]">
                            {/* <SheetHeader>
                                <SheetTitle>Menu</SheetTitle>
                            </SheetHeader> */}

                            <div className="mt-6 flex flex-col space-y-4">
                                {menus.map((menu) => (
                                    <Link
                                        key={menu.href}
                                        href={menu.href}
                                        className="text-gray-700 hover:text-gray-900"
                                        onClick={() => setOpen(false)}
                                    >
                                        {menu.name}
                                    </Link>
                                ))}
                                <Button className="mt-4" onClick={() => setOpen(false)}>
                                    Masuk
                                </Button>
                            </div>
                        </SheetContent>
                    </Sheet>
                </div>
            </div>
        </header>
    );
}

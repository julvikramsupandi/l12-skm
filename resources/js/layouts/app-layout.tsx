import { ReactNode } from "react";
import Navbar from "@/components/navbar";

interface Props {
    children: ReactNode;
}

export default function AppLayout({ children }: Props) {
    return (
        <div className="flex flex-col min-h-screen">
            <div className="pointer-events-none absolute inset-0 -z-10">
                <img src="/assets/images/bg/object-1.png" alt="image" className="pointer-events-none absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
                <img src="/assets/images/bg/object-2.png" alt="image" className="pointer-events-none absolute left-24 top-0 h-40 md:left-[30%]" />
                <img src="/assets/images/bg/object-3.png" alt="image" className="pointer-events-none absolute right-0 top-0 h-[300px]" />
                <img src="/assets/images/bg/polygon-object.svg" alt="image" className="pointer-events-none absolute bottom-0 end-[28%]" />
            </div>

            {/* Navbar */}
            <Navbar />

            {/* Content */}
            <main className="flex-1 container mx-auto px-6 py-12">
                {children}
            </main >

            {/* Footer */}
            <footer className="border-t py-6 text-center text-gray-500 text-sm" >
                © {new Date().getFullYear()} SKM. Semua hak cipta dilindungi.
            </footer>

        </div>

    );
}
